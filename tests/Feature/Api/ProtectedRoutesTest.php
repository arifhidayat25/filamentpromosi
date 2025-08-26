<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Proposal;
use App\Models\School;

class ProtectedRoutesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tes bahwa pengguna yang terautentikasi dapat mengakses data mereka.
     *
     * @return void
     */
    public function test_authenticated_user_can_access_their_data(): void
    {
        // 1. Persiapan (Arrange)
        // Buat satu user palsu
        $user = User::factory()->create();

        // 2. Aksi (Act)
        // Lakukan permintaan GET ke /api/user dengan token user tersebut
        $response = $this->actingAs($user, 'sanctum')->getJson('/api/user');

        // 3. Pengecekan (Assert)
        // Pastikan responsnya 200 OK
        $response->assertStatus(200);

        // Pastikan data user yang dikembalikan adalah user yang benar
        $response->assertJson([
            'id' => $user->id,
            'email' => $user->email,
        ]);
    }

    /**
     * Tes bahwa pengguna yang tidak terautentikasi (tamu) tidak bisa mengakses data.
     *
     * @return void
     */
    public function test_guest_cannot_access_protected_data(): void
    {
        // 2. Aksi (Act)
        // Lakukan permintaan GET ke /api/user TANPA token
        $response = $this->getJson('/api/user');

        // 3. Pengecekan (Assert)
        // Pastikan server menolak dengan status 401 Unauthorized
        $response->assertStatus(401);
    }

    /**
     * Tes bahwa pengguna hanya bisa melihat proposal miliknya sendiri.
     *
     * @return void
     */
    public function test_user_can_only_see_their_own_proposals(): void
    {
        // 1. Persiapan (Arrange)
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $school = School::factory()->create();

        // Buat proposal untuk user 1
        $proposalUser1 = Proposal::factory()->create([
            'user_id' => $user1->id,
            'school_id' => $school->id,
        ]);

        // Buat proposal untuk user 2
        $proposalUser2 = Proposal::factory()->create([
            'user_id' => $user2->id,
            'school_id' => $school->id,
        ]);

        // 2. Aksi (Act)
        // Login sebagai user 1 dan minta data proposal
        $response = $this->actingAs($user1, 'sanctum')->getJson('/api/my-proposals');

        // 3. Pengecekan (Assert)
        $response->assertStatus(200);

        // Pastikan respons JSON berisi proposal milik user 1
        $response->assertJsonFragment(['id' => $proposalUser1->id]);

        // Pastikan respons JSON TIDAK berisi proposal milik user 2
        $response->assertJsonMissing(['id' => $proposalUser2->id]);
    }
}
