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
        // Pengecekan keamanan (sudah benar)
        if ($proposal->user_id !== Auth::id() || $proposal->status !== 'selesai') {
            abort(403, 'Akses Ditolak atau Sertifikat Belum Tersedia.');
        }

        // Cek arsip (sudah benar)
        if ($proposal->certificate && Storage::disk('public')->exists($proposal->certificate->file_path)) {
            return Storage::disk('public')->download($proposal->certificate->file_path);
        }

        // --- Pengambilan Data Dinamis ---
        $mahasiswa = $proposal->user;
        $namaMahasiswa = $mahasiswa->name;
        $staffPromosi = User::whereHas('roles', fn($q) => $q->where('name', 'staff'))->first();
        $namaStaffPromosi = $staffPromosi ? $staffPromosi->name : 'Kepala Staff Promosi';

        $nomorSertifikat = sprintf(
            " %03d/SERT-PROMOSI/%s/%s/%s",
            $proposal->id,
            $mahasiswa->programStudi->kode ?? 'UMUM',
            now()->format('m'),
            now()->year
        );

        // --- Proses Pembuatan PDF ---
        $templatePath = public_path('sertifikat_template/sertifikat.pdf'); 
        $fileName = 'sertifikat/' . uniqid() . '-' . $proposal->id . '.pdf';
        $outputFile = storage_path('app/public/' . $fileName);

        if (!Storage::disk('public')->exists('sertifikat')) {
            Storage::disk('public')->makeDirectory('sertifikat');
        }
        
        // Memanggil fungsi fillPdfTemplate hanya dengan data yang diperlukan
        $this->fillPdfTemplate($templatePath, $namaMahasiswa, $namaStaffPromosi, $nomorSertifikat, $outputFile);

        // Simpan data sertifikat ke database
        $proposal->certificate()->create([
            'file_path' => $fileName,
            'certificate_number' => $nomorSertifikat,
        ]);

        return Storage::disk('public')->download($fileName);
    }

    /**
     * Mengisi template PDF dengan data pada posisi yang ditentukan.
     */
    private function fillPdfTemplate($file, $namaMahasiswa, $namaStaff, $nomorSertifikat, $outputfile)
    {
        $fpdi = new Fpdi();
        
        $fpdi->setSourceFile($file);
        $template = $fpdi->importPage(1);
        $size = $fpdi->getTemplateSize($template);

        $fpdi->addPage($size['orientation'], [$size['width'], $size['height']]);
        $fpdi->useTemplate($template);

        $fpdi->SetTextColor(0, 0, 0);

        // Fungsi helper untuk menulis teks di tengah halaman
        $centerText = function ($fpdi, $text, $y, $fontSize, $fontStyle = 'B') {
            $fpdi->SetFont("Helvetica", $fontStyle, $fontSize);
            $textWidth = $fpdi->GetStringWidth($text);
            $pageWidth = $fpdi->GetPageWidth();
            $x = ($pageWidth - $textWidth) / 2;
            $fpdi->SetXY($x, $y);
            $fpdi->Write(0, $text);
        };

        // ====================================================================
        // == KOORDINAT SUDAH DISESUAIKAN DENGAN REVISI ==
        // ====================================================================

        // 1. Menulis Nomor Sertifikat (Posisi Y dinaikkan)
        $centerText($fpdi, $nomorSertifikat, 74, 12, ''); // Posisi Y dari 78 -> 74 (lebih ke atas)

        // 2. Menulis Nama Mahasiswa (Posisi tetap)
        $centerText($fpdi, strtoupper($namaMahasiswa), 105, 32);
        
        // 3. Menulis Tanda Tangan Staff Promosi (Hanya satu, di tengah)
        $fpdi->SetFont("Helvetica", "B", 12);
        // Menggunakan fungsi centerText agar posisi X otomatis di tengah
        $centerText($fpdi, $namaStaff, 170, 12, 'B'); 
        
        $fpdi->SetFont("Helvetica", "", 12);
        // Menggunakan fungsi centerText agar posisi X otomatis di tengah
        $centerText($fpdi, 'Staff Promosi', 175, 12, '');
        
        $fpdi->output($outputfile, 'F');
    }
}