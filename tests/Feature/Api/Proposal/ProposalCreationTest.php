<?php

namespace Tests\Feature\Api\Proposal;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\School;

class ProposalCreationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tes bahwa user yang sudah login bisa membuat proposal.
     *
     * @return void
     */
    public function test_authenticated_user_can_create_proposal(): void
    {
        $user = User::factory()->create([
            'password' => 'password',
        ]);
        $school = School::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/proposals', [
            'school_id' => $school->id,
            'proposed_date' => now()->toDateString(),
            'notes' => 'Ini adalah catatan untuk tes proposal.',
        ]);

        // --- PERBAIKAN DI SINI ---
        // Kembalikan ekspektasi ke 201 Created, sesuai best practice
        // dan sesuai dengan apa yang dikembalikan oleh controller Anda.
        $response->assertStatus(201);
        $response->assertJson(['status' => 'success']);
        $this->assertDatabaseHas('proposals', [
            'user_id' => $user->id,
            'school_id' => $school->id,
        ]);
    }

    /**
     * Tes bahwa user yang belum login (tamu) tidak bisa membuat proposal.
     *
     * @return void
     */
    public function test_guest_cannot_create_proposal(): void
    {
        $school = School::factory()->create();

        $response = $this->postJson('/api/proposals', [
            'school_id' => $school->id,
            'proposed_date' => now()->toDateString(),
        ]);

        $response->assertStatus(401);
    }
}
