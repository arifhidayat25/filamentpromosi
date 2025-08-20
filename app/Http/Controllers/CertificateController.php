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

        // --- LOGIKA BARU: Cek dan Unduh dari MinIO ---
        if ($proposal->certificate && Storage::disk('minio')->exists($proposal->certificate->file_path)) {
            return Storage::disk('minio')->download($proposal->certificate->file_path);
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

        // --- LOGIKA BARU: Proses PDF dan Unggah ke MinIO ---

        // 1. Buat PDF di file sementara di server lokal
        $templatePath = public_path('sertifikat_template/sertif.pdf');
        $tempPdfPath = storage_path('app/temp/' . uniqid() . '.pdf');
        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }
        $this->fillPdfTemplate($templatePath, $namaMahasiswa, $namaStaffPromosi, $nomorSertifikat, $tempPdfPath);
        
        // 2. Tentukan nama file yang akan disimpan di MinIO
        $fileName = 'sertifikat/' . uniqid('cert-') . '-' . $proposal->id . '.pdf';

        // 3. Baca konten file sementara dan unggah ke MinIO menggunakan Storage::disk('minio')
        $fileContent = file_get_contents($tempPdfPath);
        Storage::disk('minio')->put($fileName, $fileContent, 'public');
        
        // 4. Hapus file sementara dari server lokal setelah diunggah
        unlink($tempPdfPath);
        
        // 5. Update record di database dengan path file di MinIO
        $certificate->update([
            'file_path' => $fileName,
            'certificate_number' => $nomorSertifikat,
        ]);

        // 6. Unduh file langsung dari MinIO untuk pengguna
        return Storage::disk('minio')->download($fileName);
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