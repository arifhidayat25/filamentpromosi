<?php

namespace Tests\Feature\Api\Authorization;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Proposal;
use App\Models\School;
use App\Models\ProgramStudi;
use Spatie\Permission\Models\Role;

class PembinaAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Metode ini dijalankan sebelum setiap tes untuk menyiapkan data dasar.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Buat peran-peran yang dibutuhkan
        Role::create(['name' => 'mahasiswa', 'guard_name' => 'web']);
        Role::create(['name' => 'pembina', 'guard_name' => 'web']);

        // Buat factory untuk ProgramStudi jika belum ada
        if (!class_exists(\Database\Factories\ProgramStudiFactory::class)) {
            $this->artisan('make:factory ProgramStudiFactory --model=ProgramStudi');
        }
    }

    /**
     * Tes bahwa pembina hanya bisa melihat proposal dari prodinya.
     *
     * @return void
     */
    public function test_pembina_can_only_see_proposals_from_their_program_studi(): void
    {
        // 1. Persiapan (Arrange)
        $prodiTeknik = ProgramStudi::factory()->create(['name' => 'Teknik Informatika']);
        $prodiHukum = ProgramStudi::factory()->create(['name' => 'Ilmu Hukum']);

        $pembinaTeknik = User::factory()->create([
            'password' => 'password',
            'program_studi_id' => $prodiTeknik->id,
        ]);
        $pembinaTeknik->assignRole('pembina');

        $mahasiswaTeknik = User::factory()->create([
            'password' => 'password',
            'program_studi_id' => $prodiTeknik->id,
        ]);
        $mahasiswaTeknik->assignRole('mahasiswa');

        $mahasiswaHukum = User::factory()->create([
            'password' => 'password',
            'program_studi_id' => $prodiHukum->id,
        ]);
        $mahasiswaHukum->assignRole('mahasiswa');

        $proposalTeknik = Proposal::factory()->create(['user_id' => $mahasiswaTeknik->id]);
        $proposalHukum = Proposal::factory()->create(['user_id' => $mahasiswaHukum->id]);
        
        // 2. Aksi (Act)
        // Login sebagai Pembina Teknik dan akses endpoint baru
        $response = $this->actingAs($pembinaTeknik, 'sanctum')->getJson('/api/pembina/proposals');

        // 3. Pengecekan (Assert)
        $response->assertStatus(200);
        $response->assertJson(['status' => 'success']);
        
        // Pastikan data proposal dari prodi Teknik ADA di dalam respons
        $response->assertJsonFragment(['id' => $proposalTeknik->id]);
        
        // Pastikan data proposal dari prodi Hukum TIDAK ADA di dalam respons
        $response->assertJsonMissing(['id' => $proposalHukum->id]);
    }
}
