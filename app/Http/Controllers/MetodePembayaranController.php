<?php

namespace App\Http\Controllers;

use App\Models\KategoriPembayaran;
use App\Models\MetodePembayaran;
use Illuminate\Http\Request;

class MetodePembayaranController extends Controller
{
    public function metodepembayaran(){
        $metpem = MetodePembayaran::all();
        return view('admin.kelolametodepembayaran',[
            'metpem' => $metpem
        ]);
    }

    public function tambahmetodepembayaran(){
        $kapem = KategoriPembayaran::where('status', "Aktif")->get();
        return view('admin.tambahmetodepembayaran',[
            'kapem' => $kapem
        ]);
    }

    public function prosestambahmetpem(Request $request)
    {
        $metpem = new MetodePembayaran();
        $metpem->layanan = $request->layanan;
        $metpem->no_layanan = $request->no_layanan;
        $metpem->nama_pemilik = $request->nama_pemilik;
        $metpem->kategori_layanan = $request->kategori_layanan;
        $metpem->save();

        $metpem = MetodePembayaran::latest()->first();
        $kapem = KategoriPembayaran::where('id_kapem' , $request->kategori_layanan)->first();
        $metpem->update([
            'kapem' => $kapem->kategori_pembayaran
        ]);

        return redirect()->route('admin.metodepembayaran')->with('success', 'Metode Pembayaran telah berhasil ditambahkan');
    }

    public function ubahmetodepembayaran($id)
    {
        $metpem = MetodePembayaran::where('id_metpem', $id)->first();
        $kapem = KategoriPembayaran::where('status' , "Aktif")->get();
        return view('admin.ubahmetodepembayaran', [
            'metpem' => $metpem,
            'kapem' => $kapem
        ]);
    }

    public function prosesubahmetpem(Request $request, $id)
    {
        $metpem = MetodePembayaran::where('id_metpem', $id)->first();
        if($request->layanan != null){
            $metpem->update([
                'layanan' => $request->layanan
            ]);
        }
        if($request->no_layanan != null){
            $metpem->update([
                'no_layanan' => $request->no_layanan
            ]);
        }
        if($request->nama_pemilik != null){
            $metpem->update([
                'nama_pemilik' => $request->nama_pemilik
            ]);
        }
        if($request->kategori_layanan){
            $metpem->update([
                'kategori_layanan' =>$request->kategori_layanan
            ]);
        }

        return redirect()->route('admin.metodepembayaran')->with('success', 'Metode Pembayaran telah berhasil diubah');
    }

    public function ubahstatusmetpem($id)
    {
        $metpem = MetodePembayaran::where('id_metpem', $id)->first();
        if ($metpem->status_metpem == "Aktif") {
            $metpem->update([
                'status_metpem' => "Non-Aktif"
            ]);
        } else {
            $metpem->update([
                'status_metpem' => "Aktif"
            ]);
        }
        return back()->with('success', 'Status Metode Pembayaran telah berhasil diubah');
    }
}

