<?php

namespace Tests\Feature\Api\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tes bahwa pengguna yang terautentikasi bisa logout.
     *
     * @return void
     */
    public function test_authenticated_user_can_logout(): void
    {
        // 1. Persiapan: 
        // --- PERBAIKAN DI SINI ---
        // Buat user dengan password yang kita ketahui
        $user = User::factory()->create([
            'password' => 'password',
        ]);
        $token = $user->createToken('test_token')->plainTextToken;

        // 2. Aksi: Kirim permintaan POST ke /api/logout dengan token tersebut
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/logout');

        // 3. Pengecekan:
        // Pastikan responsnya 200 OK
        $response->assertStatus(200);
        // Pastikan respons JSON memiliki status 'success'
        $response->assertJson(['status' => 'success']);
        
        // Pastikan token sudah terhapus dari database
        $this->assertDatabaseMissing('personal_access_tokens', [
            'tokenable_id' => $user->id,
        ]);
    }
}
