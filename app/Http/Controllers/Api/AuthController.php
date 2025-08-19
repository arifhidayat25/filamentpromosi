<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log; // <-- 1. IMPORT FACADE LOG

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // --- LOGGING DIMULAI ---
        Log::info('API Login attempt started.');
        Log::info('Request data:', $request->all());

        $request->validate([
            'nim' => 'required|string',
            'password' => 'required|string',
        ]);

        $nim = $request->nim;
        $password = $request->password;

        Log::info('Attempting to find user with NIM: ' . $nim);
        $user = User::where('nim', $nim)->first();

        // Cek 1: Apakah user dengan NIM tersebut ditemukan?
        if (! $user) {
            Log::warning('Login failed: User with NIM ' . $nim . ' not found.');
            return response()->json([
                'message' => 'User tidak ditemukan.'
            ], 404); // 404 Not Found
        }

        Log::info('User found: ' . $user->name);

        // Cek 2: Apakah password yang dikirim cocok dengan hash di database?
        if (! Hash::check($password, $user->password)) {
            Log::warning('Login failed: Password mismatch for user ' . $user->name);
            return response()->json([
                'message' => 'Password yang diberikan salah.'
            ], 401); // 401 Unauthorized
        }

        Log::info('Password check passed. Creating token for user: ' . $user->name);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout berhasil']);
    }
}