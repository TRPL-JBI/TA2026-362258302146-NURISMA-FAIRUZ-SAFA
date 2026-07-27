<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PelakuController;
use App\Http\Controllers\PelakuEkraf\DashboardController as PelakuDashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ImportPelakuController;
use App\Http\Controllers\Admin\VerifikasiController;
use App\Http\Controllers\Admin\StatifyController;
use App\Http\Controllers\Admin\SubsektorController;
use App\Http\Controllers\Admin\StatifyWilayahController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get(
    '/admin/statify/wilayah',
    [StatifyWilayahController::class, 'index']
)->name('admin.statify.wilayah');


Route::get('/admin/import', [ImportPelakuController::class, 'index'])
    ->name('admin.import');

Route::post('/admin/import', [ImportPelakuController::class, 'store'])
    ->name('admin.import.store');

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Redirect Dashboard Berdasarkan Role
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {

    if (auth()->user()->role == 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('pelaku.dashboard');

})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('pelaku', PelakuController::class);

        Route::get('/import', [ImportPelakuController::class, 'index'])
            ->name('import');

Route::get(
    '/subsektor',
    [SubsektorController::class, 'index']
)->name('subsektor.index');

Route::get(
    '/statify',
    [StatifyController::class, 'index']
)->name('statify.index');

Route::get(
    '/statify/kategori',
    [StatifyController::class, 'kategori']
)->name('statify.kategori');

        Route::post('/import', [ImportPelakuController::class, 'store'])
            ->name('import.store');

Route::get(
    '/statify/jumlah',
    [StatifyController::class,'jumlah']
)->name('statify.jumlah');

            Route::get(
    '/verifikasi',
    [VerifikasiController::class, 'index']
)->name('verifikasi.index');

Route::put(
    '/verifikasi/{id}',
    [VerifikasiController::class, 'update']
)->name('verifikasi.update');


});

/*
|--------------------------------------------------------------------------
| Pelaku Ekraf
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:pelaku_ekraf'])->group(function () {

    Route::get('/pelaku/dashboard', [PelakuDashboardController::class, 'index'])
        ->name('pelaku.dashboard');

});

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


require __DIR__.'/auth.php';