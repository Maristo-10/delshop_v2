<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use PDO;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function kelolaproduk(){
        $produk = Produk::all();
        return view('admin.kelolaproduk',[
            'produk'=> $produk
        ]);
    }

    public function tambahproduk(){
        return view('admin.tambahproduk');
    }

    public function prosestambahproduk(Request $request){
        $request->validate([
            'nama_produk' => 'required',
            'harga_jual' => 'required',
            'harga_modal' => 'required',
            'jumlah_produk' => 'required',
            'kategori_produk' => 'required',
            'kategori_pembeli' => 'required',
            'deskripsi' => 'required',
            'gambar_produk' => 'required|image|file|max:10000',
        ]);
        $arrName = [];
        $tambahproduk = new Produk();
        $tambahproduk->nama_produk = $request->nama_produk;
        $tambahproduk->harga = $request->harga_jual;
        $tambahproduk->modal = $request->harga_modal;
        $tambahproduk->jumlah_produk = $request->jumlah_produk;
        $tambahproduk->kategori_produk = $request->kategori_produk;
        $tambahproduk->role_pembeli = $request->kategori_pembeli;
        $tambahproduk->deskripsi = $request->deskripsi;

        if ($request->file('gambar_produk')) {
            if ($request->hasfile('gambar_produk')) {
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('gambar_produk')->getClientOriginalName());
                $request->file('gambar_produk')->move(public_path('product-images'), $filename);
                $tambahproduk->gambar_produk = $filename;
            }
        }
        if (!$tambahproduk->save()) {
            if (count($arrName) > 1) {
                foreach ($arrName as $path) {
                    unlink(public_path() . $path);
                }
            }
        }
        return redirect()->route("admin.kelolaproduk")->with('success', 'Data Produk Berhasil Di Tambahkan');
    }

    public function ubahproduk($id){
        $produk = Produk::where('id_produk', $id)->first();
        return view('admin.ubahproduk',[
            'produk'=> $produk
        ]);
    }

    public function prosesubahproduk(Request $request, $id){
        $request->validate([
            'nama_produk' => 'required',
            'harga_jual' => 'required',
            'harga_modal' => 'required',
            'jumlah_produk' => 'required',
            'kategori_produk' => 'required',
            'kategori_pembeli' => 'required',
            'deskripsi' => 'required',
            'gambar_produk' => 'required|image|file|max:10000',
        ]);
        $produk = Produk::where('id_produk', $id)->first();

        if ($request->file('gambar_produk')) {
            if ($request->hasfile('gambar_produk')) {
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('gambar_produk')->getClientOriginalName());
                $request->file('gambar_produk')->move(public_path('product-images'), $filename);
                $produk->update(['gambar_produk' => $filename]);
            }
        }

        $produk->update([
        'nama_produk' => $request->nama_produk,
        'harga' => $request->harga_jual,
        'modal' => $request->harga_modal,
        'jumlah_produk' => $request->jumlah_produk,
        'kategori_produk' => $request->kategori_produk,
        'role_pembeli' => $request->kategori_pembeli,
        'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route("admin.kelolaproduk")->with('success', 'Data Produk Berhasil Diubah');
    }

    public function ubahstatusproduk($id){
        $produk = Produk::where('id_produk', $id)->first();

        if($produk->status_produk == 'Non-Aktif'){
            $produk->update([
                'status_produk' => 'Aktif'
            ]);
        }else{
            $produk->update([
                'status_produk' => 'Non-Aktif'
            ]);
        }

        return redirect()->route("admin.kelolaproduk")->with('success', 'Status Produk Berhasil Diubah');
    }

    public function penjualanproduk(){
        $now = Carbon::now()->format('Y');
        $produk = DB::table('produk')
            ->leftJoin('pesanandetails', function ($join) {
                $join->on('produk.id_produk', '=', 'pesanandetails.produk_id')
                    ->where('pesanandetails.updated_at', '>=', Carbon::now()->subYear());
            })
            ->leftJoin('pesanans', function ($join) {
                $join->on('pesanandetails.pesanan_id', '=', 'pesanans.id')
                    ->where('pesanans.status', '=', 'Selesai');
            })
            ->select('produk.nama_produk','produk.harga', 'produk.jumlah_produk', 'produk.deskripsi', 'produk.kategori_produk', 'produk.ukuran_produk','produk.warna', 'produk.angkatan', 'produk.id_produk','produk.gambar_produk','produk.role_pembeli')
            ->selectRaw('SUM(CASE WHEN YEAR(pesanans.tanggal) = '.$now.' THEN COALESCE(pesanandetails.jumlah, 0) ELSE 0 END) AS total')
            ->selectRaw('SUM(CASE WHEN MONTH(pesanans.tanggal) = 1 THEN COALESCE(pesanandetails.jumlah, 0) ELSE 0 END) AS januari')
            ->selectRaw('SUM(CASE WHEN MONTH(pesanans.tanggal) = 2 THEN COALESCE(pesanandetails.jumlah, 0) ELSE 0 END) AS februari')
            ->selectRaw('SUM(CASE WHEN MONTH(pesanans.tanggal) = 3 THEN COALESCE(pesanandetails.jumlah, 0) ELSE 0 END) AS maret')
            ->selectRaw('SUM(CASE WHEN MONTH(pesanans.tanggal) = 4 THEN COALESCE(pesanandetails.jumlah, 0) ELSE 0 END) AS april')
            ->selectRaw('SUM(CASE WHEN MONTH(pesanans.tanggal) = 5 THEN COALESCE(pesanandetails.jumlah, 0) ELSE 0 END) AS mei')
            ->selectRaw('SUM(CASE WHEN MONTH(pesanans.tanggal) = 6 THEN COALESCE(pesanandetails.jumlah, 0) ELSE 0 END) AS juni')
            ->selectRaw('SUM(CASE WHEN MONTH(pesanans.tanggal) = 7 THEN COALESCE(pesanandetails.jumlah, 0) ELSE 0 END) AS juli')
            ->selectRaw('SUM(CASE WHEN MONTH(pesanans.tanggal) = 8 THEN COALESCE(pesanandetails.jumlah, 0) ELSE 0 END) AS agustus')
            ->selectRaw('SUM(CASE WHEN MONTH(pesanans.tanggal) = 9 THEN COALESCE(pesanandetails.jumlah, 0) ELSE 0 END) AS september')
            ->selectRaw('SUM(CASE WHEN MONTH(pesanans.tanggal) = 10 THEN COALESCE(pesanandetails.jumlah, 0) ELSE 0 END) AS oktober')
            ->selectRaw('SUM(CASE WHEN MONTH(pesanans.tanggal) = 11 THEN COALESCE(pesanandetails.jumlah, 0) ELSE 0 END) AS november')
            ->selectRaw('SUM(CASE WHEN MONTH(pesanans.tanggal) = 12 THEN COALESCE(pesanandetails.jumlah, 0) ELSE 0 END) AS desember')
            ->groupBy('id_produk','produk.nama_produk', 'produk.harga', 'produk.jumlah_produk', 'produk.deskripsi', 'produk.kategori_produk', 'produk.ukuran_produk','produk.warna', 'produk.angkatan','produk.gambar_produk','produk.role_pembeli')
            ->orderBy('total', 'DESC')
            ->get();
        return view('admin.detailpenjualanproduk',[
            'produk'=>$produk
        ]);
    }
}
