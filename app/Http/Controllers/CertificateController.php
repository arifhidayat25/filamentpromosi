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
        if ($proposal->user_id !== Auth::id() || $proposal->status !== 'selesai') {
            abort(403, 'Akses Ditolak atau Sertifikat Belum Tersedia.');
        }

        if ($proposal->certificate && Storage::disk('public')->exists($proposal->certificate->file_path)) {
            return Storage::disk('public')->download($proposal->certificate->file_path);
        }

        // --- PENGAMBILAN DATA DINAMIS ---
        $mahasiswa = $proposal->user;
        $namaMahasiswa = $mahasiswa->name;
        $staffPromosi = User::whereHas('roles', fn($q) => $q->where('name', 'staff'))->first();
        $namaStaffPromosi = $staffPromosi ? $staffPromosi->name : 'Kepala Staff Promosi';

        // --- PROSES PEMBUATAN PDF (LOGIKA BARU) ---

        // 1. Buat record sertifikat sementara untuk mendapatkan ID
        $certificate = $proposal->certificate()->create([
            'file_path' => 'temp', // Nilai sementara
        ]);

        // 2. Buat nomor sertifikat LENGKAP menggunakan ID yang baru didapat
        $nomorSertifikat = sprintf(
            "No: %03d/SERT-PROMOSI/%d/%s/%s/%s",
            $certificate->id, // <-- Menggunakan ID Sertifikat
            $proposal->id,
            $mahasiswa->programStudi->kode ?? 'UMUM',
            $this->getRomanMonth(now()->month),
            now()->year
        );

        // 3. Siapkan path file
        $templatePath = public_path('sertifikat_template/sertif.pdf'); 
        $fileName = 'sertifikat/' . uniqid() . '-' . $proposal->id . '.pdf';
        $outputFile = storage_path('app/public/' . $fileName);

        if (!Storage::disk('public')->exists('sertifikat')) {
            Storage::disk('public')->makeDirectory('sertifikat');
        }
        
        // 4. Generate PDF dengan nomor yang sudah lengkap
        $this->fillPdfTemplate($templatePath, $namaMahasiswa, $namaStaffPromosi, $nomorSertifikat, $outputFile);

        // 5. Update record sertifikat dengan data final
        $certificate->update([
            'file_path' => $fileName,
            'certificate_number' => $nomorSertifikat,
        ]);

        // 6. Unduh file
        return Storage::disk('public')->download($fileName);
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

        // Menulis Nomor Sertifikat (di bawah tulisan "SERTIFIKAT")
        $centerText($fpdi, $nomorSertifikat, 70, 15, ''); // Ukuran font disesuaikan agar muat

        // Menulis Nama Mahasiswa
        $centerText($fpdi, strtoupper($namaMahasiswa), 105, 32, 'B');
        
        // Menulis Tanda Tangan Staff Promosi
        $centerText($fpdi, $namaStaff, 170, 12, 'B');
        $centerText($fpdi, 'Staff Promosi', 175, 12, '');
        
        $fpdi->output($outputfile, 'F');
    }

    private function getRomanMonth($month) {
        $map = [1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'];
        return $map[$month] ?? '';
    }
}
