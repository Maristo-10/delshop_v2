<?php

use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home/dashboard_pembeli');
});

Route::get('/produk', function () {
    return view('pembeli/produk');
});

Route::get('/detailproduk', function () {
    return view('pembeli/detailproduk');
});

Route::get('/keranjang', function () {
    return view('pembeli/keranjang');
});

Route::get('/checkout', function () {
    return view('pembeli/checkout');
});

Route::get('/riwayat-pesanan', function () {
    return view('pembeli/riwayatpesanan');
});

Route::get('/detail-pesanan', function () {
    return view('pembeli/detailpesanan');
});


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
