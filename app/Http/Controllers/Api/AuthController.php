<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    /**
     * Register Pelaku Ekraf
     */
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pelaku_ekraf',
        ]);

        // Kirim email verifikasi
        $user->sendEmailVerificationNotification();

        return response()->json([
            'message' => 'Registrasi berhasil. Silakan cek email Anda untuk melakukan verifikasi.',
        ], 201);
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Email atau Password salah.',
            ], 401);
        }

        $user = Auth::user();

        if (!$user->hasVerifiedEmail()) {

            Auth::logout();

            return response()->json([
                'message' => 'Silakan verifikasi email terlebih dahulu.',
            ], 403);
        }

        if ($user->role !== 'pelaku_ekraf') {

            Auth::logout();

            return response()->json([
                'message' => 'API ini hanya dapat digunakan oleh Pelaku Ekraf.',
            ], 403);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil.',
            'token' => $token,
            'user' => $user,
        ]);
    }

    /**
     * Profile
     */
    public function profile(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout berhasil.',
        ]);
    }
}