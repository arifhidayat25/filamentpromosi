<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Proposal;
use App\Models\School;
use App\Models\ProgramStudi;
use Spatie\Permission\Models\Role;

class PembinaApprovalTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Tes alur pembina menyetujui proposal.
     *
     * @return void
     */
    public function testPembinaCanApproveProposal(): void
    {
        // 1. Persiapan (Arrange)
        // Buat roles
        Role::firstOrCreate(['name' => 'mahasiswa']);
        Role::firstOrCreate(['name' => 'pembina']);

        // Buat prodi dan sekolah
        $prodi = ProgramStudi::factory()->create();
        $sekolah = School::factory()->create();

        // Buat user mahasiswa dan pembina dari prodi yang sama
        $mahasiswa = User::factory()->create(['program_studi_id' => $prodi->id]);
        $mahasiswa->assignRole('mahasiswa');

        $pembina = User::factory()->create(['program_studi_id' => $prodi->id]);
        $pembina->assignRole('pembina');

        // Buat proposal yang diajukan oleh mahasiswa
        $proposal = Proposal::factory()->create([
            'user_id' => $mahasiswa->id,
            'school_id' => $sekolah->id,
            'dosen_pembina_id' => $pembina->id,
            'status' => 'diajukan'
        ]);

        // 2. Aksi & Pengecekan
        $this->browse(function (Browser $browser) use ($pembina, $proposal) {
            $browser->loginAs($pembina, 'web') // Login sebagai pembina
                    ->visit('/admin/proposals/' . $proposal->id . '/edit') // Kunjungi halaman edit proposal
                    ->assertSee('Informasi Pengajuan')

                    // Pilih opsi untuk menyetujui
                    ->select('status', 'disetujui_pembina')

                    ->press('Save changes') // Klik tombol simpan

                    ->assertPathIs('/admin/proposals') // Kembali ke halaman daftar
                    ->assertSee('Disetujui Pembina'); // Cek status baru di tabel
        });
    }
}