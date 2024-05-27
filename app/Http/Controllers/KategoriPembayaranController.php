<?php

namespace App\Http\Controllers;

use App\Models\KategoriPembayaran;
use Illuminate\Http\Request;

class KategoriPembayaranController extends Controller
{
    public function kategoripembayaran()
    {
        $kapem = KategoriPembayaran::all();
        return view('admin.kategoripembayaran', [
            'kapem' => $kapem
        ]);
    }

    public function tambahkategoripembayaran()
    {
        return view('admin.tambahkategoripembayaran');
    }

    public function prosestambahkapem(Request $request)
    {
        $kapem = new KategoriPembayaran();
        $kapem->kategori_pembayaran = $request->kategori_pembayaran;
        $kapem->save();

        return redirect()->route('admin.kategoripembayaran')->with('success', 'Kategori Pembayaran telah berhasil ditambahkan');
    }

    public function ubahkategoripembayaran($id)
    {
        $kapem = KategoriPembayaran::where('id_kapem', $id)->first();
        return view('admin.ubahkategoripembayaran', [
            'kapem' => $kapem
        ]);
    }

    public function prosesubahkapem(Request $request, $id)
    {
        $kapem = KategoriPembayaran::where('id_kapem', $id)->first();
        $kapem->update([
            'kategori_pembayaran' => $request->kategori_pembayaran
        ]);

        return redirect()->route('admin.kategoripembayaran')->with('success', 'Kategori Pembayaran telah berhasil diubah');
    }

    public function ubahstatuskapem($id)
    {
        $kapem = KategoriPembayaran::where('id_kapem', $id)->first();
        if ($kapem->status == "Aktif") {
            $kapem->update([
                'status' => "Non-Aktif"
            ]);
        } else {
            $kapem->update([
                'status' => "Aktif"
            ]);
        }
        return back()->with('success', 'Status Kategori Pembayaran telah berhasil diubah');
    }
}
