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
        // Buat user dengan password yang kita ketahui
        $user = User::factory()->create([
            'password' => 'password',
        ]);

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/user');

        $response->assertStatus(200);
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
        $response = $this->getJson('/api/user');
        $response->assertStatus(401);
    }

    /**
     * Tes bahwa pengguna hanya bisa melihat proposal miliknya sendiri.
     *
     * @return void
     */
    public function test_user_can_only_see_their_own_proposals(): void
    {
        $user1 = User::factory()->create(['password' => 'password']);
        $user2 = User::factory()->create(['password' => 'password']);
        
        $school = School::factory()->create();

        $proposalUser1 = Proposal::factory()->create([
            'user_id' => $user1->id,
            'school_id' => $school->id,
        ]);

        $proposalUser2 = Proposal::factory()->create([
            'user_id' => $user2->id,
            'school_id' => $school->id,
        ]);

        $response = $this->actingAs($user1, 'sanctum')->getJson('/api/my-proposals');

        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $proposalUser1->id]);
        $response->assertJsonMissing(['id' => $proposalUser2->id]);
    }
}
