<?php

namespace App\Http\Controllers;

use App\Models\KategoriProdukModel;
use Illuminate\Http\Request;

class KategoriProdukController extends Controller
{
    public function kelolakategoriproduk(){
        $kategoriproduk = KategoriProdukModel::all();
        return view('admin.kelolakategoriproduk',[
            'kategoriproduk'=> $kategoriproduk
        ]);
    }

    public function tambahkategoriproduk(){
        return view('admin.tambahkategoriproduk');
    }

    public function prosestambahkategoriproduk(Request $request){
        $request->validate([
            'kategori' => 'required',
            'gambar_kategori' => 'required|image|file|max:10000',
        ]);
        $arrName = [];
        $tambahkategori = new KategoriProdukModel();
        $tambahkategori->kategori = $request->kategori;

        if ($request->file('gambar_kategori')) {
            if ($request->hasfile('gambar_kategori')) {
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('gambar_kategori')->getClientOriginalName());
                $request->file('gambar_kategori')->move(public_path('kategori-produk-images'), $filename);
                $tambahkategori->gambar_kategori = $filename;
            }
        }
        if (!$tambahkategori->save()) {
            if (count($arrName) > 1) {
                foreach ($arrName as $path) {
                    unlink(public_path() . $path);
                }
            }
        }
        return redirect()->route("admin.kelolakategoriproduk")->with('success', 'Data Kategori Produk Berhasil Di Tambahkan');
    }

    public function ubahstatuskategoriproduk($kategori){
        $kategoris = KategoriProdukModel::where('kategori', $kategori)->first();
        if($kategoris->status_kategori == 'Aktif'){
            $kategoris->update([
                'status_kategori' => 'Non-Aktif'
            ]);
        }else{
            $kategoris->update([
                'status_kategori' => 'Aktif'
            ]);
        }

        return redirect()->route("admin.kelolakategoriproduk")->with('success', 'Status Kategori Produk Berhasil Diubah');
    }

    public function ubahkategoriproduk($kategori){
        $kategoris = KategoriProdukModel::where('kategori', $kategori)->first();
        return view('admin.ubahkategoriproduk',[
            'kategoris'=>$kategoris
        ]);
    }

    public function prosesubahkategoriproduk(Request $request, $kategori){
        $request->validate([
            'kategori' => 'required',
            'gambar_kategori' => 'required|image|file|max:10000',
        ]);
        $kategoris = KategoriProdukModel::where('kategori', $kategori)->first();

        if ($request->file('gambar_kategori')) {
            if ($request->hasfile('gambar_kategori')) {
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('gambar_kategori')->getClientOriginalName());
                $request->file('gambar_kategori')->move(public_path('kategori-produk-images'), $filename);
                $kategoris->update(['gambar_kategori' => $filename]);
            }
        }

        $kategoris->update([
        'kategori' => $request->kategori,
        ]);

        return redirect()->route("admin.kelolakategoriproduk")->with('success', 'Data Kategori Produk Berhasil Diubah');
    }
}
