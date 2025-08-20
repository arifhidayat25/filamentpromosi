<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'nim' => 'required|string',
                'password' => 'required|string',
            ]);

            $user = User::where('nim', $request->nim)->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                // Gunakan 'fail' karena masalah ada pada data yang dikirim klien
                return ResponseFormatter::fail(null, 'NIM atau Password salah', 401);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return ResponseFormatter::success([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
            ], 'Login Berhasil');

        } catch (ValidationException $e) {
            // Tangkap khusus error validasi dan gunakan 'fail'
            return ResponseFormatter::fail($e->errors(), 'Validasi gagal');
        } catch (\Exception $e) {
            // Tangkap semua error server lainnya
            return ResponseFormatter::error('Terjadi kesalahan pada server');
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return ResponseFormatter::success(null, 'Logout berhasil');
    }
}