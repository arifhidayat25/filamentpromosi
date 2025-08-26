<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testSuccessfulLogin()
    {
        // Membuat user untuk pengujian
        $user = User::factory()->create([
            'email' => 'pengguna@tes.com',
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/student/login') // 1. Kunjungi halaman login
                    ->type('email', $user->email) // 2. Isi input email
                    ->type('password', 'password') // 3. Isi input password
                    ->press('Login') // 4. Klik tombol Login
                    ->assertPathIs('/dashboard'); // 5. Pastikan halaman dialihkan ke dashboard
        });
    }
}