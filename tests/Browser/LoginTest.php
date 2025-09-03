<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_student_can_login_successfully(): void
    {
        // Persiapan: Buat peran dan user mahasiswa
        Role::create(['name' => 'mahasiswa', 'guard_name' => 'web']);
        $student = User::factory()->create([
            'email' => 'mahasiswa@test.com',
            'password' => Hash::make('password123'), // password harus di-hash
        ]);
        $student->assignRole('mahasiswa');

        $this->browse(function (Browser $browser) use ($student) {
            $browser->visit('/student/login')
                    ->assertSee('Login Portal Student')
                    
                    ->type('#data\.email', $student->email)
                    ->type('#data\.password', 'password123')
                    
                    ->press('Sign in') // ganti sesuai label tombol submit
                    ->waitForLocation('/student') // sesuaikan route redirect
                    ->assertPathIs('/student')
                    ->assertSee('Dashboard');
        });
    }
}
