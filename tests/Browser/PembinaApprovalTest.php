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
use Spatie\Permission\Models\Permission;

class PembinaApprovalTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testPembinaCanApproveProposal(): void
    {
        // --- PERBAIKAN DI SINI: Siapkan Roles dan Permissions ---
        $roleMahasiswa = Role::firstOrCreate(['name' => 'mahasiswa', 'guard_name' => 'web']);
        $rolePembina = Role::firstOrCreate(['name' => 'pembina', 'guard_name' => 'web']);
        
        // Buat permission yang dibutuhkan untuk mengakses halaman edit
        $permission = Permission::firstOrCreate(['name' => 'update_proposal', 'guard_name' => 'web']);
        $rolePembina->givePermissionTo($permission);

        // Persiapan data lainnya
        $prodi = ProgramStudi::factory()->create();
        $sekolah = School::factory()->create();

        $mahasiswa = User::factory()->create(['program_studi_id' => $prodi->id, 'password' => 'password']);
        $mahasiswa->assignRole($roleMahasiswa);

        $pembina = User::factory()->create(['program_studi_id' => $prodi->id, 'password' => 'password']);
        $pembina->assignRole($rolePembina);

        $proposal = Proposal::factory()->create([
            'user_id' => $mahasiswa->id,
            'school_id' => $sekolah->id,
            'dosen_pembina_id' => $pembina->id,
            'status' => 'diajukan'
        ]);

        $this->browse(function (Browser $browser) use ($pembina, $proposal) {
            $browser->loginAs($pembina, 'web')
                    ->visit('/admin/proposals/' . $proposal->id . '/edit')
                    ->waitForText('Edit Ajuan Promosi') // Tunggu hingga halaman dimuat
                    ->assertSee('Edit Ajuan Promosi')

                    ->select('data.status', 'disetujui_pembina')
                    ->press('Save changes')

                    ->waitForLocation('/admin/proposals')
                    ->assertPathIs('/admin/proposals')
                    ->assertSee('Disetujui Pembina');
        });
    }
}
