<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Spatie\Permission\Models\Role;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\School;

class MahasiswaProposalTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Tes alur lengkap seorang mahasiswa mengajukan proposal.
     *
     * @return void
     */
    public function testMahasiswaCanCreateProposalSuccessfully(): void
    {
        // 1. Persiapan (Arrange)
        // Buat role 'mahasiswa' jika belum ada
        Role::firstOrCreate(['name' => 'mahasiswa']);

        // Buat satu user mahasiswa
        $mahasiswa = User::factory()->create();
        $mahasiswa->assignRole('mahasiswa');

        // Buat satu data sekolah sebagai tujuan proposal
        $sekolah = School::factory()->create([
            'name' => 'SMA Negeri 1 Impian'
        ]);

        // 2. Aksi & Pengecekan (Act & Assert)
        $this->browse(function (Browser $browser) use ($mahasiswa, $sekolah) {
            $browser->loginAs($mahasiswa, 'web') // Login sebagai mahasiswa
                    ->visit('/student/proposals/create') // Kunjungi halaman buat proposal
                    ->screenshot('halaman_setelah_login')
                    ->assertSee('Create Proposal - laravel') // Pastikan ada di halaman yang benar

                    // Pilih sekolah dari dropdown
                    ->select('school_id', $sekolah->id)

                    // Isi deskripsi pengajuan
                    ->type('notes', 'Ini adalah tes deskripsi untuk kegiatan promosi di sekolah.')

                    ->press('Create') // Klik tombol 'Create'

                    // Pengecekan setelah submit
                    ->assertPathIs('/student/proposals') // Pastikan kembali ke halaman daftar
                    ->assertSee('SMA Negeri 1 Impian') // Pastikan proposal baru muncul di tabel
                    ->assertSee('diajukan'); // Pastikan statusnya 'diajukan'
        });
    }
}