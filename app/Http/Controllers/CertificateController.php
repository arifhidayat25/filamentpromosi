<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
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

        // --- LOGIKA BARU DENGAN TABEL TERPISAH ---

        // 1. Cek apakah sertifikat sudah ada di tabel 'certificates'
        if ($proposal->certificate && Storage::disk('public')->exists($proposal->certificate->file_path)) {
            // Jika ada, langsung unduh dari path yang tersimpan
            return Storage::disk('public')->download($proposal->certificate->file_path);
        }

        // 2. Jika belum ada, buat PDF baru
        $namaMahasiswa = $proposal->user->name;
        $namaKetuaPelaksana = 'Rufus Hewart';
        $templatePath = public_path('sertifikat_template/sertifikat.pdf');
        
        $fileName = 'sertifikat/' . uniqid() . '-' . $proposal->id . '.pdf';
        $outputFile = storage_path('app/public/' . $fileName);

        if (!Storage::disk('public')->exists('sertifikat')) {
            Storage::disk('public')->makeDirectory('sertifikat');
        }
        
        $this->fillPdfTemplate($templatePath, $namaMahasiswa, $namaKetuaPelaksana, $outputFile);

        // 3. Simpan record baru di tabel 'certificates'
        $proposal->certificate()->create([
            'file_path' => $fileName,
        ]);

        // 4. Kirim file yang baru dibuat untuk diunduh
        return Storage::disk('public')->download($fileName);
    }

    /**
     * Fungsi ini tidak perlu diubah.
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
        $fpdi->Write(0, $ketua);

        $fpdi->output($outputfile, 'F');
    }
}