<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\User; // <-- Tambahkan ini
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;

class CertificateController extends Controller
{
    public function generate(Proposal $proposal)
    {
        // ... (kode keamanan Anda tetap sama)
        if ($proposal->user_id !== Auth::id() || $proposal->status !== 'selesai') {
            abort(403, 'Akses Ditolak atau Sertifikat Belum Tersedia.');
        }

        // --- LOGIKA BARU DIMULAI DI SINI ---
        $mahasiswa = $proposal->user;
        $namaMahasiswa = $mahasiswa->name;

        // 1. Cari Pembina berdasarkan prodi Mahasiswa
        $pembina = User::where('program_studi_id', $mahasiswa->program_studi_id)
                       ->whereHas('roles', fn($q) => $q->where('name', 'pembina'))
                       ->first();
        
        // 2. Tentukan nama yang akan dicetak
        $namaPembina = $pembina ? $pembina->name : 'Ketua Pelaksana'; // Jika pembina tidak ditemukan, gunakan nama default

        // Cek arsip, jika ada langsung unduh
        if ($proposal->certificate && Storage::disk('public')->exists($proposal->certificate->file_path)) {
            return Storage::disk('public')->download($proposal->certificate->file_path);
        }

        // Jika belum ada, buat PDF baru
        $templatePath = public_path('sertifikat_template/sertifikat.pdf');
        $fileName = 'sertifikat/' . uniqid() . '-' . $proposal->id . '.pdf';
        $outputFile = storage_path('app/public/' . $fileName);

        if (!Storage::disk('public')->exists('sertifikat')) {
            Storage::disk('public')->makeDirectory('sertifikat');
        }
        
        // 3. Kirim nama pembina yang dinamis ke fungsi pembuat PDF
        $this->fillPdfTemplate($templatePath, $namaMahasiswa, $namaPembina, $outputFile);

        // Simpan ke arsip
        $proposal->certificate()->create([
            'file_path' => $fileName,
        ]);

        return Storage::disk('public')->download($fileName);
    }

    /**
     * Parameter kedua sekarang adalah nama pembina/ketua.
     */
    private function fillPdfTemplate($file, $nama, $ketua, $outputfile)
    {
        $fpdi = new Fpdi();
        $fpdi->setSourceFile($file);
        $template = $fpdi->importPage(1);
        $size = $fpdi->getTemplateSize($template);
        $fpdi->addPage($size['orientation'], [$size['width'], $size['height']]);
        $fpdi->useTemplate($template);

        $centerText = function ($fpdi, $text, $y, $fontSize) {
            $fpdi->SetFont("Helvetica", "B", $fontSize);
            $textWidth = $fpdi->GetStringWidth($text);
            $pageWidth = $fpdi->GetPageWidth();
            $x = ($pageWidth - $textWidth) / 2;
            $fpdi->SetXY($x, $y);
            $fpdi->Write(0, $text);
        };

        $fpdi->SetTextColor(0, 0, 0);
        $centerText($fpdi, $nama, 85, 42);

        $fpdi->SetFont("Helvetica", "", 12);
        $textWidthKetua = $fpdi->GetStringWidth($ketua);
        $xKetua = (297 - $textWidthKetua) / 2;
        $fpdi->SetXY($xKetua, 184);
        $fpdi->Write(0, $ketua); // Mencetak nama pembina yang sudah ditemukan

        $fpdi->output($outputfile, 'F');
    }
}