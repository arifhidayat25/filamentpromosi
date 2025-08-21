<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;

class CertificateController extends Controller
{
    public function generate(Proposal $proposal)
    {
        // Validasi akses tetap sama
        if (($proposal->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) || $proposal->status !== 'selesai') {
            abort(403, 'Akses Ditolak atau Sertifikat Belum Tersedia.');
        }

        // --- PERBAIKAN 1: Gunakan 'response()' untuk mengunduh ---
        if ($proposal->certificate && Storage::disk('minio')->exists($proposal->certificate->file_path)) {
            // Menggunakan response() untuk streaming file langsung dari MinIO
            return Storage::disk('minio')->response($proposal->certificate->file_path);
        }

        // Pengambilan data dinamis tetap sama
        $mahasiswa = $proposal->user;
        $namaMahasiswa = $mahasiswa->name;
        $staffPromosi = User::role('staff')->first();
        $namaStaffPromosi = $staffPromosi ? $staffPromosi->name : 'Kepala Staff Promosi';

        $certificate = $proposal->certificate()->create(['file_path' => 'temp']);

        $nomorSertifikat = sprintf(
            "No: %03d/SERT-PROMOSI/%d/%s/%s/%s",
            $certificate->id,
            $proposal->id,
            $mahasiswa->programStudi->kode ?? 'UMUM',
            $this->getRomanMonth(now()->month),
            now()->year
        );

        // Proses pembuatan PDF dan unggah ke MinIO tetap sama
        $templatePath = public_path('sertifikat_template/sertif.pdf');
        $tempPdfPath = storage_path('app/temp/' . uniqid() . '.pdf');
        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }
        $this->fillPdfTemplate($templatePath, $namaMahasiswa, $namaStaffPromosi, $nomorSertifikat, $tempPdfPath);
        
        $fileName = 'sertifikat/' . uniqid('cert-') . '-' . $proposal->id . '.pdf';

        $fileContent = file_get_contents($tempPdfPath);
        Storage::disk('minio')->put($fileName, $fileContent);
        
        unlink($tempPdfPath);
        
        $certificate->update([
            'file_path' => $fileName,
            'certificate_number' => $nomorSertifikat,
        ]);

        // --- PERBAIKAN 2: Gunakan 'response()' juga di sini ---
        // Unduh file yang baru dibuat menggunakan streaming
        return Storage::disk('minio')->response($fileName);
    }

    private function fillPdfTemplate($file, $namaMahasiswa, $namaStaff, $nomorSertifikat, $outputfile)
    {
        $fpdi = new Fpdi();
        $fpdi->setSourceFile($file);
        $template = $fpdi->importPage(1);
        $size = $fpdi->getTemplateSize($template);
        $fpdi->addPage($size['orientation'], [$size['width'], $size['height']]);
        $fpdi->useTemplate($template);
        $fpdi->SetTextColor(0, 0, 0);

        $centerText = function ($fpdi, $text, $y, $fontSize, $fontStyle = 'B') {
            $fpdi->SetFont("Helvetica", $fontStyle, $fontSize);
            $textWidth = $fpdi->GetStringWidth($text);
            $pageWidth = $fpdi->GetPageWidth();
            $x = ($pageWidth - $textWidth) / 2;
            $fpdi->SetXY($x, $y);
            $fpdi->Write(0, $text);
        };

        $centerText($fpdi, $nomorSertifikat, 70, 15, '');
        $centerText($fpdi, strtoupper($namaMahasiswa), 105, 32, 'B');
        $centerText($fpdi, $namaStaff, 170, 12, 'B');
        $centerText($fpdi, 'Staff Promosi', 175, 12, '');
        
        $fpdi->output($outputfile, 'F');
    }

    private function getRomanMonth($month) {
        $map = [1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'];
        return $map[$month] ?? '';
    }
}