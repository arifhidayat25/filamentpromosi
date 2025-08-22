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
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            $user = User::where('email', $request->email)->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                // Menggunakan 'error' untuk kredensial yang salah
                return ResponseFormatter::error(null, 'Email atau Password salah', 401);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return ResponseFormatter::success([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
            ], 'Login Berhasil');

        } catch (ValidationException $e) {
            // Menggunakan 'error' untuk validasi yang gagal
            return ResponseFormatter::error($e->errors(), 'Validasi gagal', 422);
        } catch (\Exception $e) {
            // Menggunakan 'error' untuk masalah server
            return ResponseFormatter::error(null, 'Terjadi kesalahan pada server', 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return ResponseFormatter::success(null, 'Logout berhasil');
    }
}