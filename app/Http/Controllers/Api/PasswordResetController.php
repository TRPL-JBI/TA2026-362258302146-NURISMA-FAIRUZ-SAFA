<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    /**
     * Mengirim link reset password ke email user
     */
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

\Log::info('Reset password diminta untuk email: ' . $request->email);

        if ($status !== Password::RESET_LINK_SENT) {

            return response()->json([
                'message' => __($status),
            ], 400);

        }

        return response()->json([
            'message' =>
                'Link reset password berhasil dikirim ke email Anda.',
        ]);
    }

    /**
     * Mengubah password user
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only(
                'email',
                'password',
                'password_confirmation',
                'token'
            ),

            function ($user, $password) {

                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

            }
        );

        if ($status !== Password::PASSWORD_RESET) {

            return response()->json([
                'message' => __($status),
            ], 400);

        }

        return response()->json([
            'message' =>
                'Password berhasil diubah. Silakan login kembali.',
        ]);
    }
}