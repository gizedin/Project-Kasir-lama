<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DiskonController;

Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
});

//user
Route::middleware(['auth'])->group(function () {

    // HOME USER (BARANG + DISKON)
    Route::get('/home', [HomeController::class, 'home'])
        ->name('home');

    // DETAIL BARANG (DENGAN DISKON)
    Route::get('/produk/{barang}', [BarangController::class, 'show'])
        ->name('user.barang.show');

    // transaksi user
    Route::post('/transaksi/bayar', [TransaksiController::class, 'bayar'])
        ->name('user.transaksi.bayar');
    Route::post('/transaksi/store', [TransaksiController::class, 'store'])
        ->name('user.transaksi.store');
    Route::get('/transaksi/{transaksi}/struk', [TransaksiController::class, 'struk'])
        ->name('user.transaksi.struk');

});

//admin
Route::middleware(['auth'])->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [HomeController::class, 'index'])
        ->name('dashboard');

    //akun
    Route::get('/akun', [AkunController::class, 'index'])
        ->name('admin.akun.index');
    Route::get('/akun/create', [AkunController::class, 'create'])
        ->name('admin.akun.create');
    Route::post('/akun', [AkunController::class, 'store'])
        ->name('admin.akun.store');
    Route::get('/akun/{akun}/edit', [AkunController::class, 'edit'])
        ->name('admin.akun.edit');
    Route::put('/akun/{akun}', [AkunController::class, 'update'])
        ->name('admin.akun.update');
    Route::delete('/akun/{akun}', [AkunController::class, 'destroy'])
        ->name('admin.akun.destroy');

    //barang
    Route::get('/barang', [BarangController::class, 'index'])
        ->name('admin.barang.index');
    Route::get('/barang/create', [BarangController::class, 'create'])
        ->name('admin.barang.create');
    Route::post('/barang', [BarangController::class, 'store'])
        ->name('admin.barang.store');
    Route::get('/barang/{barang}/edit', [BarangController::class, 'edit'])
        ->name('admin.barang.edit');
    Route::put('/barang/{barang}', [BarangController::class, 'update'])
        ->name('admin.barang.update');
    Route::delete('/barang/{barang}', [BarangController::class, 'destroy'])
        ->name('admin.barang.destroy');


    //diskon
    Route::get('/diskon', [DiskonController::class, 'index'])
        ->name('admin.diskon.index');
    Route::get('/diskon/create', [DiskonController::class, 'create'])
        ->name('admin.diskon.create');
    Route::post('/diskon', [DiskonController::class, 'store'])
        ->name('admin.diskon.store');
    Route::get('/diskon/{diskon}/edit', [DiskonController::class, 'edit'])
        ->name('admin.diskon.edit');
    Route::put('/diskon/{diskon}', [DiskonController::class, 'update'])
        ->name('admin.diskon.update');
    Route::delete('/diskon/{diskon}', [DiskonController::class, 'destroy'])
        ->name('admin.diskon.destroy');

    // transaksi 
    Route::get('/transaksi', [TransaksiController::class, 'index'])
        ->name('admin.transaksi.index');

});
