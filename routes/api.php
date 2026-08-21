<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StatifyApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PengajuanController;
use App\Http\Controllers\Api\MasterDataController;
use App\Http\Controllers\Api\PasswordResetController;
use App\Http\Controllers\Api\PelakuEkrafController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Api\GoogleMapsController;

Route::post('/resolve-google-maps', [
    GoogleMapsController::class,
    'resolve'
]);

Route::post(
    '/forgot-password',
    [PasswordResetController::class, 'forgotPassword']
);

Route::post(
    '/reset-password',
    [PasswordResetController::class, 'resetPassword']
);

Route::get('/verify-email/{id}/{hash}', function ($id, $hash, Request $request) {

    // cek signature URL
    if (! $request->hasValidSignature()) {
        abort(403, 'Link verifikasi tidak valid.');
    }

    // cari user berdasarkan primary key id_user
    $user = User::where('id_user', $id)->firstOrFail();

    // pastikan hash email sesuai
    if (! hash_equals(
        sha1($user->getEmailForVerification()),
        $hash
    )) {
        abort(403, 'Hash email tidak sesuai.');
    }

    // verifikasi
    if (! $user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
    }

    return redirect("https://ideahub.my.id/email-success");

})->name('verification.verify');

Route::middleware('auth:sanctum')->group(function () {
});

Route::get('/statify', [StatifyApiController::class, 'index']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get(
    '/pelaku-ekraf/map',
    [PelakuEkrafController::class, 'map']
);

Route::get(
    '/subsektor',
    [MasterDataController::class, 'subsektor']
);

Route::get(
    '/wilayah',
    [MasterDataController::class, 'wilayah']
);


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/profile', [AuthController::class, 'profile']);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get(
    '/data-saya',
    [PengajuanController::class, 'dataSaya']
);

    Route::post('/pengajuan', [PengajuanController::class,'store']);

    Route::put('/pengajuan/update', [PengajuanController::class, 'update']);

    Route::get( '/status-pengajuan', [PengajuanController::class,'status']);

    Route::get('/riwayat-pengajuan', [PengajuanController::class, 'riwayat']);

    Route::middleware('auth:sanctum')->get(
    '/pengajuan/opsi-form',
    [PengajuanController::class, 'opsiForm']
);

});