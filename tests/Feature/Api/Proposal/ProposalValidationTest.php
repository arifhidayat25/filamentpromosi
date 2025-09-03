<?php

namespace Tests\Feature\Api\Proposal;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\School;

class ProposalValidationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tes bahwa API menolak permintaan jika school_id tidak ada.
     *
     * @return void
     */
    public function test_proposal_creation_fails_if_school_id_is_missing(): void
    {
        $user = User::factory()->create(['password' => 'password']);

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/proposals', [
            // 'school_id' sengaja dikosongkan
            'proposed_date' => now()->toDateString(),
            'notes' => 'Tes tanpa school_id.',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('school_id');
    }

    /**
     * Tes bahwa API menolak permintaan jika proposed_date tidak ada.
     *
     * @return void
     */
    public function test_proposal_creation_fails_if_proposed_date_is_missing(): void
    {
        $user = User::factory()->create(['password' => 'password']);

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/proposals', [
            'school_id' => School::factory()->create()->id,
            // 'proposed_date' sengaja dikosongkan
            'notes' => 'Tes tanpa proposed_date.',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('proposed_date');
    }
}
