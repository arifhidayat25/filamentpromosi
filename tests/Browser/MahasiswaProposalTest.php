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

    public function testMahasiswaCanCreateProposalSuccessfully(): void
    {
        // Persiapan
        Role::firstOrCreate(['name' => 'mahasiswa', 'guard_name' => 'web']);
        $mahasiswa = User::factory()->create(['password' => 'password123']);
        $mahasiswa->assignRole('mahasiswa');
        $sekolah = School::factory()->create(['name' => 'SMA Negeri 1 Impian']);

        $this->browse(function (Browser $browser) use ($mahasiswa, $sekolah) {
            $browser->loginAs($mahasiswa, 'web')
                    ->visit('/student/proposals/create')
                    // --- PERBAIKAN DI SINI ---
                    ->waitForText('Create Proposal', 5) // Tunggu hingga halaman dimuat
                    ->assertSee('Create Proposal')

                    // Gunakan selector yang benar untuk form Filament (data.nama_field)
                    ->select('data.school_id', $sekolah->id)
                    ->type('data.notes', 'Ini adalah tes deskripsi untuk kegiatan promosi di sekolah.')
                    
                    // Cari tombol berdasarkan teksnya
                    ->press('Create')

                    ->waitForLocation('/student/proposals')
                    ->assertPathIs('/student/proposals')
                    ->assertSee('SMA Negeri 1 Impian');
        });
    }
}
