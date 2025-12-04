<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisProdukController; // Import Controller Jenis Produk
use App\Http\Controllers\ProdukController; // Import Controller Produk
use App\Http\Controllers\ProfileController; // Bawaan Breeze




Route::get('/', function () {
    return redirect()->route('login');
});




Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('jenis_produk', JenisProdukController::class);

    Route::resource('produk', ProdukController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';