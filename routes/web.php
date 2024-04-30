<?php

use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesananController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [Controller::class, 'dash_pembeli'])->name('home.dashboard_pembeli');
Route::get('/produk', [ProdukController::class, 'produk'])->name('pembeli.produk');
Route::get('/detailproduk/{id}',[ProdukController::class, 'detailproduk'])->name('pembeli.detailproduk');
Route::post('/tambah/keranjang/{id}',[PesananController::class, 'tambahkeranjang'])->name('pembeli.tambahkeranjang');
Route::get('/keranjang',[PesananController::class, 'keranjang'])->name('pembeli.keranjang');
Route::get('/checkout',[PesananController::class, 'checkout'])->name('pembeli.checkout');
Route::post('/proses/checkout',[PesananController::class, 'prosescheckout'])->name('pembeli.prosescheckout');
Route::post('/checkout/produk', [PesananController::class, 'checkoutproduk'])->name('pembeli.checkoutproduk');
Route::get('/riwayat-pesanan', [PesananController::class, 'riwayatpesanan'])->name('pembeli.riwayatpesanan');
Route::get('/batalkan/pesanan/{id}',[PesananController::class, 'batalkanpesanan'])->name('pembeli.batalkanpesanan');
Route::get('/detail-pesanan/{kode}', [PesananController::class, 'detailpesanan'])->name('pembeli.detailpesanan');



//admin

Route::get('/dashboard', function () {
    return view('home.dashboard_admin');
});

Route::get('/kelola/produk', [ProdukController::class, 'kelolaproduk'])->name('admin.kelolaproduk');
Route::get('/tambah/produk', [ProdukController::class, 'tambahproduk'])->name('admin.tambahproduk');
Route::post('/proses/tambah/produk',[ProdukController::class, 'prosestambahproduk'])->name('admin.prosestambahproduk');
Route::get('/ubah/produk/{id}', [ProdukController::class, 'ubahproduk'])->name('admin.ubahproduk');
Route::post('/proses/ubah/produk/{id}',[ProdukController::class, 'prosesubahproduk'])->name('admin.prosesubahproduk');
Route::get('/proses/ubah/status/produk/{id}', [ProdukController::class, 'ubahstatusproduk'])->name('admin.updatestatusproduk');

Route::get('/kelola/kategori-produk', [KategoriProdukController::class, 'kelolakategoriproduk'])->name('admin.kelolakategoriproduk');
Route::get('/tambah/kategori-produk', [KategoriProdukController::class, 'tambahkategoriproduk'])->name('admin.tambahkategoriproduk');
Route::post('/proses/tambah/kategori-produk',[KategoriProdukController::class, 'prosestambahkategoriproduk'])->name('admin.prosestambahkategoriproduk');
Route::get('/proses/ubah/status/kategori-produk/{kategori}', [KategoriProdukController::class, 'ubahstatuskategoriproduk'])->name('admin.updatestatuskategoriproduk');
Route::get('/ubah/kategori-produk/{kategori}', [KategoriProdukController::class, 'ubahkategoriproduk'])->name('admin.ubahkategoriproduk');
Route::post('/proses/ubah/kategori-produk/{kategori}',[KategoriProdukController::class, 'prosesubahkategoriproduk'])->name('admin.prosesubahkategoriproduk');
Route::get('/detail/penjualan/produk', [ProdukController::class, 'penjualanproduk'])->name('admin.detailpenjualanproduk');

Route::get('/konfirmasi/pesanan',[PesananController::class, 'konfirmasipesanan'])->name('admin.konfirmasipesanan');
Route::get('/proses/konfirmasi/pesanan/{id}',[PesananController::class, 'proseskonfirmasi'])->name('admin.proseskonfirmasi');
Route::post('/pembatalan/pesanan/{id}',[PesananController::class, 'pembatalan'])->name('admin.pembatalanpesanan');
Route::get('/pesanan/diproses',[PesananController::class, 'pesanandiproses'])->name('admin.pesanandiproses');
Route::get('/proses/selesai/pesanan/{id}',[PesananController::class, 'prosesselesai'])->name('admin.prosesselesai');
Route::get('/pesanan/selesai',[PesananController::class, 'pesananselesai'])->name('admin.pesananselesai');
Route::get('/pesanan/dibatalkan',[PesananController::class, 'pesanandibatalkan'])->name('admin.pesanandibatalkan');
