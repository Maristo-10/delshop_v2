<?php

use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CorouselController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriPembayaranController;
use App\Http\Controllers\MetodePembayaranController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as Request2;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

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

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password-request');

Route::post('/forgot-password', function (Request2 $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password-email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password-reset');

Route::post('/reset-password', function (Request2 $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password-update');

Route::get('/read-notification/{id}', [UserController::class, 'markAsRead'])->name('read.notification');



Route::get('/', [Controller::class, 'dash_pembeli'])->name('home.dashboard_pembeli');
Route::get('/profile', [UserController::class, 'profile'])->name('pembeli.profile');
Route::post('/profile/update', [UserController::class, 'uprofile'])->name('pembeli.updateprofile');


Route::get('/produk', [ProdukController::class, 'produk'])->name('pembeli.produk');
Route::get('/produk/{kategori}', [ProdukController::class, 'produk_kat'])->name('pembeli.produkkat');
Route::get('/search', [ProdukController::class, 'search']);

Route::get('/detailproduk/{id}',[ProdukController::class, 'detailproduk'])->name('pembeli.detailproduk');
Route::post('/tambah/keranjang/{id}',[PesananController::class, 'tambahkeranjang'])->name('pembeli.tambahkeranjang');
Route::get('/keranjang',[PesananController::class, 'keranjang'])->name('pembeli.keranjang');
Route::get('/data/pesanan/{id}',[PesananController::class, 'datapesanan'])->name('datapesanan');
Route::get('/checkout',[PesananController::class, 'checkout'])->name('pembeli.checkout');
Route::post('/proses/checkout',[PesananController::class, 'prosescheckout'])->name('pembeli.prosescheckout');
Route::post('/checkout/produk', [PesananController::class, 'checkoutproduk'])->name('pembeli.checkoutproduk');
Route::get('/riwayat-pesanan', [PesananController::class, 'riwayatpesanan'])->name('pembeli.riwayatpesanan');
Route::get('/batalkan/pesanan/{id}',[PesananController::class, 'batalkanpesanan'])->name('pembeli.batalkanpesanan');
Route::get('/detail-pesanan/{kode}', [PesananController::class, 'detailpesanan'])->name('pembeli.detailpesanan');

Route::get('/beli/sekarang/{id}/{jlh}/{variasi}',[PesananController::class, 'belisekarang'])->name('pembeli.belisekarang');
Route::post('/checkout/sekarang/produk', [PesananController::class, 'checkoutsekarangproduk'])->name('pembeli.checkoutsekarangproduk');
Route::get('/hapus/keranjang/{id}', [PesananController::class, 'hapuskeranjang'])->name('hapuskeranjang');



//admin

Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('home.dashboard-admin');

Route::get('/kelola/produk', [ProdukController::class, 'kelolaproduk'])->name('admin.kelolaproduk');
Route::get('/kelola/corousel', [CorouselController::class, 'kelolacorousel'])->name('admin.kelolacorousel');
Route::post('/ubah/corousel/{id}', [CorouselController::class, 'ubahCorousel'])->name('admin.ubahcorousel');
Route::get('/ubah-status-corousel/{id}',[CorouselController::class, 'ustatus_corousel'])->name('admin.ustatuscorousel');
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

Route::get('/metode/pembayaran',[MetodePembayaranController::class, 'metodepembayaran'])->name('admin.metodepembayaran');
Route::get('/tambah/metode/pembayaran',[MetodePembayaranController::class, 'tambahmetodepembayaran'])->name('admin.tambahmetodepembayaran');
Route::post('/proses/tambah/metode/pembayaran',[MetodePembayaranController::class, 'prosestambahmetpem'])->name('admin.prosestambahmetpem');
Route::get('/ubah/metode/pembayaran/{id}',[MetodePembayaranController::class, 'ubahmetodepembayaran'])->name('admin.ubahmetodepembayaran');
Route::post('/proses/ubah/metode/pembayaran/{id}',[MetodePembayaranController::class, 'prosesubahmetpem'])->name('admin.prosesubahmetpem');
Route::get('/ubah/status/metode/pembayaran/{id}',[MetodePembayaranController::class, 'ubahstatusmetpem'])->name('admin.ubahstatusmetpem');

Route::get('/kategori/pembayaran',[KategoriPembayaranController::class, 'kategoripembayaran'])->name('admin.kategoripembayaran');
Route::get('/tambah/kategori/pembayaran',[KategoriPembayaranController::class, 'tambahkategoripembayaran'])->name('admin.tambahkategoripembayaran');
Route::post('/proses/tambah/kategori/pembayaran',[KategoriPembayaranController::class, 'prosestambahkapem'])->name('admin.prosestambahkapem');
Route::get('/ubah/kategori/pembayaran/{id}',[KategoriPembayaranController::class, 'ubahkategoripembayaran'])->name('admin.ubahkategoripembayaran');
Route::post('/proses/ubah/kategori/pembayaran/{id}',[KategoriPembayaranController::class, 'prosesubahkapem'])->name('admin.prosesubahkapem');
Route::get('/ubah/status/kategori/pembayaran/{id}',[KategoriPembayaranController::class, 'ubahstatuskapem'])->name('admin.ubahstatuskapem');

Route::get('/laporan/penjualan', [PesananController::class, 'laporanpenjualan'])->name('admin.laporanpenjualan');
Route::get('/export/laporan/penjualan', [PesananController::class, 'exportlaporanpenjualan'])->name('admin.exportlaporanpenjualan');

Route::get('/laporan/labarugi', [PesananController::class, 'laporanlabarugi'])->name('admin.laporanlabarugi');
Route::get('/export/laporan/labarugi', [PesananController::class, 'exportlaporanlabarugi'])->name('admin.exportlaporanlabarugi');

Route::get('/kelola/pengguna',[UserController::class, 'kelolapengguna'])->name('admin.kelolapengguna');
Route::get('/tambah/pengguna',[UserController::class, 'tambahpengguna'])->name('admin.tambahpengguna');
Route::post('/proses/tambah/pengguna', [UserController::class, 'prosestambahpengguna'])->name('admin.prosestambahpengguna');
Route::get('/import/pengguna',[UserController::class, 'importpengguna'])->name('admin.importpengguna');
Route::post('/proses/import/pengguna', [UserController::class, 'prosesimportpengguna'])->name('admin.prosesimportpengguna');


Auth::routes(['verify' => true]);

Route::get('/home', function () {
    return redirect()->route('home.dashboard_pembeli');
})->name('home')->middleware('verified');

Route::post('/email/resend', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Link verifikasi telah dikirim ke alamat email Anda.');
})->middleware('auth')->name('verification.resend');
