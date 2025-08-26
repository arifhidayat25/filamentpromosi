<?php

namespace Tests\Feature\Api\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginTest extends TestCase
{
    // Trait ini akan secara otomatis me-reset database sebelum setiap tes,
    // memastikan setiap tes berjalan di lingkungan yang bersih.
    use RefreshDatabase;

    /**
     * Tes skenario di mana login berhasil dengan kredensial yang valid.
     *
     * @return void
     */
    public function test_user_can_login_with_valid_credentials(): void
    {
        // 1. Persiapan (Arrange)
        // Buat satu user palsu di database untuk tes ini.
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        // 2. Aksi (Act)
        // Simulasikan permintaan POST ke endpoint /api/login
        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        // 3. Pengecekan (Assert)
        // Pastikan server memberikan respons "200 OK"
        $response->assertStatus(200);

        // Pastikan respons JSON memiliki struktur yang kita harapkan
        $response->assertJsonStructure([
            'status',
            'code',
            'message',
            'data' => [
                'access_token',
                'token_type',
                'user' => [
                    'id',
                    'name',
                    'email',
                ],
            ],
        ]);

        // Pastikan status di dalam JSON adalah 'success'
        $response->assertJson(['status' => 'success']);
    }

    /**
     * Tes skenario di mana login gagal karena password salah.
     *
     * @return void
     */
    public function test_user_cannot_login_with_invalid_password(): void
    {
        // 1. Persiapan (Arrange)
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        // 2. Aksi (Act)
        // Kirim permintaan dengan password yang SALAH
        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password-salah',
        ]);

        // 3. Pengecekan (Assert)
        // Pastikan server memberikan respons "401 Unauthorized"
        $response->assertStatus(401);

        // Pastikan status di dalam JSON adalah 'error'
        $response->assertJson(['status' => 'error']);
    }

    /**
     * Tes skenario di mana login gagal karena email tidak ada.
     *
     * @return void
     */
    public function test_user_cannot_login_with_non_existent_email(): void
    {
        // 2. Aksi (Act)
        // Kirim permintaan dengan email yang tidak terdaftar
        $response = $this->postJson('/api/login', [
            'email' => 'tidakada@example.com',
            'password' => 'password123',
        ]);

        // 3. Pengecekan (Assert)
        // Pastikan server memberikan respons "401 Unauthorized"
        $response->assertStatus(401);

        // Pastikan status di dalam JSON adalah 'error'
        $response->assertJson(['status' => 'error']);
    }
}
