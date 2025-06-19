<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\TransportasiController;
use App\Http\Controllers\LayananTambahanController;
use App\Http\Controllers\KategoriDestinasiController;

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
    return view('rekomendasi.index');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/Destinasi', [App\Http\Controllers\DestinasiController::class, 'index'])->name('Destinasi');
Route::get('/Transportasi', [App\Http\Controllers\TransportasiController::class, 'index'])->name('Transportasi');
Route::get('/LayananTambahan', [App\Http\Controllers\LayananTambahanController::class, 'index'])->name('LayananTambahan');
Route::get('/Paket', [App\Http\Controllers\PaketController::class, 'index'])->name('Paket');
Route::resource('kategori', KategoriDestinasiController::class);


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
//Destinasi:Wisatawan
Route::get('/', [DestinasiController::class, 'showwisatawan'])->name('wisatawan.index');

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

//Rekomendasi
Route::get('/rekomendasi', [RekomendasiController::class, 'rekomendasi'])->name('rekomendasi.cari');
Route::post('/rekomendasi/edit-redirect', [RekomendasiController::class, 'redirectToEdit'])->name('rekomendasi.editRedirect');
Route::get('/rekomendasi/edit', [RekomendasiController::class, 'edit'])->name('rekomendasi.edit');
Route::post('/rekomendasi/simpan', [RekomendasiController::class, 'simpan'])->name('rekomendasi.simpan');
Route::post('/rekomendasi/edit/tambah', [RekomendasiController::class, 'tambah'])->name('rekomendasi.tambah');
Route::post('/rekomendasi/edit/hapus', [RekomendasiController::class, 'hapus'])->name('rekomendasi.hapus');
Route::post('/rekomendasi/{id}/tambah-destinasi', [RekomendasiController::class, 'tambahDestinasi']);
Route::delete('/rekomendasi/{id}/hapus-destinasi', [RekomendasiController::class, 'hapusDestinasi']);
Route::post('/rekomendasi/batalkan', [RekomendasiController::class, 'batalkan'])->name('rekomendasi.batalkan');
Route::get('/rekomendasi/pesanan', [RekomendasiController::class, 'pesanan'])->name('rekomendasi.pesanan');

//Pesanan
Route::post('/konfirmasi', [PesananController::class, 'konfirmasi'])->name('konfirmasi.pesanan');
Route::post('/pesanan/store', [PesananController::class, 'store'])->name('pesanan.store');
Route::get('/pesanan/{id}/download', [PesananController::class, 'download'])->name('pesanan.download');
Route::get('/pengelola/pesanan/{id}', [PesananController::class, 'show'])->name('pengelola.pesanan.show');
Route::get('/pengelola/pesanan/{id}/cetak', [PesananController::class, 'cetak'])->name('pengelola.pesanan.cetak');
Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
Route::get('/pesanan/verifikasi/{id}', [PesananController::class, 'verifikasi'])->name('pesanan.verifikasi');
Route::get('/pesanan/{id}/sukses', [PesananController::class, 'konfirmasiSukses'])->name('pesanan.sukses');
Route::get('/pesanan/{id}/kuitansi', [PesananController::class, 'cetakKuitansi'])->name('pesanan.kuitansi');
Route::get('/pesanan/arsip', [PesananController::class, 'arsip'])->name('pesanan.arsip');

//Pembayaran
Route::post('/pesanan/{id}/upload-bukti', [PembayaranController::class, 'uploadBukti'])->name('pembayaran.uploadBukti');
Route::get('/pembayaran/verifikasi/{id}', [PembayaranController::class, 'verifikasi'])->name('pembayaran.verifikasi');
Route::put('/pembayaran/konfirmasi/{id}', [PembayaranController::class, 'konfirmasi'])->name('pembayaran.konfirmasi');
Route::post('/pembayaran/upload/{id}', [PembayaranController::class, 'uploadBukti'])->name('pembayaran.upload');
Route::post('/pembayaran/upload/manual/{pesanan}', [PembayaranController::class, 'uploadManual'])->name('pembayaran.uploadManual');

//Kategori
Route::get('/kategori', [KategoriDestinasiController::class, 'index'])->name('kategori.index');
Route::get('/pengelola/destinasi/kategori/create', [KategoriDestinasiController::class, 'create'])->name('kategori.create');
Route::post('/pengelola/destinasi/kategori/store', [KategoriDestinasiController::class, 'store'])->name('kategori.store');
