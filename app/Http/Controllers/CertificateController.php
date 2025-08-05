<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Support\Facades\Auth;
use setasign\Fpdi\Fpdi;

class CertificateController extends Controller
{
    /**
     * Fungsi utama untuk membuat dan mengirimkan PDF sertifikat.
     */
    public function generate(Proposal $proposal)
    {
        // Keamanan 1: Pastikan hanya pemilik proposal yang bisa mengunduh
        if ($proposal->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak');
        }

        // Keamanan 2: Pastikan proposal statusnya sudah 'selesai'
        if ($proposal->status !== 'selesai') {
            abort(403, 'Sertifikat untuk pengajuan ini belum tersedia.');
        }

        // Mengambil data yang diperlukan dari relasi model Anda
        $namaMahasiswa = $proposal->user->name;
        $namaSekolah = $proposal->school->name;
        
        // Anda bisa mengganti "Rufus Hewart" dengan nama yang dinamis jika perlu
        $namaKetuaPelaksana = 'Rufus Hewart'; 

        // Tentukan lokasi template dan file output
        $templatePath = public_path('sertifikat_template/sertifikat.pdf'); // Pastikan file template ada di sini
        $outputFile = storage_path('app/public/sertifikat/sertifikat-' . $proposal->id . '.pdf');

        // Pastikan folder output ada, jika tidak, buat baru
        if (!is_dir(storage_path('app/public/sertifikat'))) {
            mkdir(storage_path('app/public/sertifikat'), 0755, true);
        }
        
        // Panggil fungsi untuk mengisi PDF
        $this->fillPdfTemplate($templatePath, $namaMahasiswa, $namaSekolah, $namaKetuaPelaksana, $outputFile);

        // Kirim file PDF yang sudah jadi ke browser untuk diunduh
        return response()->file($outputFile);
    }

    /**
     * Fungsi ini bertugas mengisi template PDF dengan posisi yang sudah disesuaikan.
     */
    private function fillPdfTemplate($file, $nama, $skl, $ketua, $outputfile)
    {
        $fpdi = new Fpdi();
        $fpdi->setSourceFile($file);
        $template = $fpdi->importPage(1);
        $size = $fpdi->getTemplateSize($template);
        $fpdi->addPage($size['orientation'], [$size['width'], $size['height']]);
        $fpdi->useTemplate($template);

        // Helper function untuk menempatkan teks di tengah halaman
        $centerText = function ($fpdi, $text, $y, $fontSize) {
            $fpdi->SetFont("Helvetica", "B", $fontSize); // Font Bold
            $textWidth = $fpdi->GetStringWidth($text);
            $pageWidth = $fpdi->GetPageWidth();
            $x = ($pageWidth - $textWidth) / 2;
            $fpdi->SetXY($x, $y);
            $fpdi->Write(0, $text);
        };

        $fpdi->SetTextColor(0, 0, 0); // Warna teks hitam

        // Menulis Nama Mahasiswa (posisi diturunkan sedikit, font diperbesar)
        $centerText($fpdi, $nama, 85, 42);

        // Menulis Nama Sekolah (posisi diturunkan, font disesuaikan)
        $centerText($fpdi, $skl, 142, 22);

        // Menulis Nama Ketua Pelaksana
        

        // Simpan file PDF yang sudah diisi
        $fpdi->output($outputfile, 'F');
    }
}