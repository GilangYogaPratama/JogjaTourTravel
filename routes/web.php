<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\TransportasiController;
use App\Http\Controllers\LayananTambahanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/Destinasi', [App\Http\Controllers\DestinasiController::class, 'index'])->name('Destinasi');
Route::get('/Transportasi', [App\Http\Controllers\TransportasiController::class, 'index'])->name('Transportasi');
Route::get('/LayananTambahan', [App\Http\Controllers\LayananTambahanController::class, 'index'])->name('LayananTambahan');
Route::get('/Paket', [App\Http\Controllers\PaketController::class, 'index'])->name('Paket');

Route::resource('destinasi', DestinasiController::class);
Route::resource('transportasi', TransportasiController::class);
Route::resource('layanantambahan', LayananTambahanController::class);
Route::resource('paket', PaketController::class);

//Destinasi
Route::get('/destinasi/create', [App\Http\Controllers\DestinasiController::class, 'create'])->name('createDestinasi');
Route::post('/destinasi/create', [App\Http\Controllers\DestinasiController::class, 'store'])->name('storeDestinasi');
Route::get('/destinasi/{id}/edit', [App\Http\Controllers\DestinasiController::class, 'edit'])->name('editDestinasi');
Route::post('/destinasi/{id}/edit', [App\Http\Controllers\DestinasiController::class, 'update'])->name('updateDestinasi');
Route::post('/destinasi/{id}/delete', [App\Http\Controllers\DestinasiController::class, 'destroy'])->name('deleteDestinasi');

//Transportasi
Route::get('/transportasi/create', [App\Http\Controllers\TransportasiController::class, 'create'])->name('createTransportasi');
Route::post('/transportasi/create', [App\Http\Controllers\TransportasiController::class, 'store'])->name('storeTransportasi');
Route::get('/transportasi/{id}/edit', [App\Http\Controllers\TransportasiController::class, 'edit'])->name('editTransportasi');
Route::post('/transportasi/{id}/edit', [App\Http\Controllers\TransportasiController::class, 'update'])->name('updateTransportasi');
Route::post('/transportasi/{id}/delete', [App\Http\Controllers\TransportasiController::class, 'destroy'])->name('deleteTransportasi');

//Layanan Tambahan
Route::get('/layanantambahan/create', [App\Http\Controllers\LayananTambahanController::class, 'create'])->name('createLayananTambahan');
Route::post('/layanantambahan/create', [App\Http\Controllers\LayananTambahanController::class, 'store'])->name('storeLayananTambahan');
Route::get('/layanantambahan/{id}/edit', [App\Http\Controllers\LayananTambahanController::class, 'edit'])->name('editLayananTambahan');
Route::post('/layanantambahan/{id}/edit', [App\Http\Controllers\LayananTambahanController::class, 'update'])->name('updateLayananTambahan');
Route::post('/layanantambahan/{id}/delete', [App\Http\Controllers\LayananTambahanController::class, 'destroy'])->name('deleteLayananTambahan');

//Paket
Route::get('/paket/create', [App\Http\Controllers\PaketController::class, 'create'])->name('createPaket');
Route::post('/paket/create', [App\Http\Controllers\PaketController::class, 'store'])->name('storePaket');
Route::get('/paket/{id}/edit', [App\Http\Controllers\PaketController::class, 'edit'])->name('editPaket');
Route::post('/paket/{id}/edit', [App\Http\Controllers\PaketController::class, 'update'])->name('updatePaket');
Route::post('/paket/{id}/delete', [App\Http\Controllers\PaketController::class, 'destroy'])->name('deletePaket');
