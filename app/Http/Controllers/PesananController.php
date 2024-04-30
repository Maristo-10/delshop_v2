<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class PesananController extends Controller
{
    //pembeli

    public function keranjang()
    {
        $keranjang = Pesanan::where('status', 'Keranjang')->first();
        $detail_keranjang = DetailPesanan::join('produk', 'produk.id_produk', '=', 'pesanandetails.produk_id')
            ->where('pesanan_id', $keranjang->id)
            ->where('produk.status_produk', 'Aktif')
            ->get();
        foreach ($detail_keranjang as $data) {
            $jumlah_pesanan[] = $data->jumlah;
        }
        $total_pesanan = array_sum($jumlah_pesanan);
        return view('pembeli.keranjang', [
            'keranjang' => $keranjang,
            'detail_keranjang' => $detail_keranjang,
            'total_pesanan' => $total_pesanan
        ]);
    }

    public function tambahkeranjang(Request $request, $id)
    {
        $produk = Produk::where('id_produk', $id)->first();
        $tanggal = Carbon::now();
        $date = $tanggal->format('Y-m-d');
        $jumlah_pesanan = Pesanan::where('tanggal', $date)->count();


        if ($request->jumlah_pes > $produk->jumlah_produk) {
            return back()->with('error', 'Jumlah Produk Tidak Mencukupi!');
        }

        $cek_keranjang = Pesanan::where('user_id', 1)->where('status', 'Keranjang')->first();
        if (empty($cek_keranjang)) {
            $keranjang = new Pesanan;
            $keranjang->user_id = 1;
            $keranjang->tanggal = $tanggal;
            $keranjang->total_harga = 0;
            $keranjang->save();
        }

        $now = $tanggal->format('Ymd');
        $cek_keranjang->update([
            'kode' => "DEL$now$jumlah_pesanan"
        ]);
        $cek_detailpesanan = DetailPesanan::where('produk_id', $produk->id_produk)->where('pesanan_id', $cek_keranjang->id)->first();
        if ($cek_detailpesanan == null) {
            $pesanan_detail = new DetailPesanan();
            $pesanan_detail->produk_id = $produk->id_produk;
            $pesanan_detail->pesanan_id = $cek_keranjang->id;
            $pesanan_detail->jumlah = $request->jumlah_pes;
            $pesanan_detail->jumlah_harga = $produk->harga * $request->jumlah_pes;
            // $pesanan_detail->ukurans = $request->ukuran;
            // $pesanan_detail->warn    a_produk = $request->warna;
            // $pesanan_detail->angkatans = $request->angkatan;
            $pesanan_detail->modal_details = $produk->modal * $request->jumlah_pes;
            $pesanan_detail->save();
        }

        if ($cek_detailpesanan != null) {
            $jumlah_pesanan_detail_baru = $request->jumlah_pes;
            $cek_detailpesanan->jumlah = $cek_detailpesanan->jumlah + $jumlah_pesanan_detail_baru;
            $harga_pesanan_detail_baru = $produk->harga * $request->jumlah_pes;
            $cek_detailpesanan->jumlah_harga = $cek_detailpesanan->jumlah_harga + $harga_pesanan_detail_baru;
            $modal_pesanan_detail_baru = $produk->modal * $request->jumlah_pes;
            $cek_detailpesanan->modal_details = $cek_detailpesanan->modal_details + $modal_pesanan_detail_baru;
            $cek_detailpesanan->update();
        }

        $cek_keranjang->total_harga = $cek_keranjang->total_harga + ($produk->harga * $request->jumlah_pes);
        $cek_keranjang->modal_pesanan = $cek_keranjang->modal_pesanan + ($produk->modal * $request->jumlah_pes);
        $cek_keranjang->update();
        return redirect()->route("pembeli.keranjang")->with('success', 'Produk telah berhasil dimasukkan ke dalam keranjang');
    }

    public function checkout()
    {
        return view('pembeli.checkout');
    }

    public function prosescheckout(Request $request)
    {
        $selectedItems = $request->input('selected_items');
        foreach ($selectedItems as $itemId) {
            // Lakukan operasi checkout untuk setiap item yang dicentang
            $item[] = DetailPesanan::join('produk', 'produk.id_produk', '=', 'pesanandetails.produk_id')->where('id', $itemId)->where('produk.status_produk', 'Aktif')->first();

            // $item->status = 'checkout';
            // $item->save();
        }
        return view('pembeli.checkout', [
            'item' => $item
        ]);
    }

    public function checkoutproduk(Request $request)
    {
        $tanggal = Carbon::now();
        $date = $tanggal->format('Y-m-d');
        $jumlah_pesanan = Pesanan::where('tanggal', $date)->count();
        $now = $tanggal->format('Ymd');

        $selected_id = $request->id_pesanan;
        $arr_id = explode(',', $selected_id);
        foreach ($arr_id as $sel_id) {
            $pesanan[] = DetailPesanan::where('id', $sel_id)->first();
        }

        $keranjang = DetailPesanan::join('pesanans', 'pesanans.id', '=', 'pesanandetails.pesanan_id')->where('pesanans.status', 'Keranjang')->get();
        $checkout = Pesanan::where('id', $pesanan[0]->pesanan_id)->first();
        if (count($keranjang) == count($pesanan)) {
            $checkout->update([
                'status'=> "Menunggu",
                'kode' => "DEL$now$jumlah_pesanan"
            ]);
            return redirect()->route('pembeli.riwayatpesanan')->with('success', 'Produk telah berhasil dipesan. Menunggu konfirmasi pesanan!');
        } else {
            $h = 0;
            $m = 0;
            foreach ($pesanan as $pes) {
                $h += $pes->jumlah_harga;
                $m += $pes->modal_details;
            }
            $sisa_hargaK = $checkout->total_harga - $h;
            $sisa_modalK = $checkout->modal_pesanan - $m;

            $checkout->update([
                'total_harga' => $sisa_hargaK,
                'modal_pesanan' => $sisa_modalK
            ]);

            $kode = "DEL$now$jumlah_pesanan";
            $cek_pesanan = Pesanan::where('kode', $kode)->first();

            if (empty($cek_pesanan)) {
                $pesanan_baru = new Pesanan();
                $pesanan_baru->user_id = 1;
                $pesanan_baru->tanggal = $tanggal;
                $pesanan_baru->total_harga = 0;
                $pesanan_baru->status = "Menunggu";
                $pesanan_baru->save();
            }
            $jumlah_Npesanan = Pesanan::where('tanggal', $date)->count();
            $cek_pesanan->update([
                'kode' => "DEL$now$jumlah_Npesanan",
                'total_harga' => $h,
                'modal_pesanan' => $m,
            ]);

            foreach ($pesanan as $pes) {
                $pes->update([
                    'pesanan_id' => $cek_pesanan->id,
                ]);
            }

            return redirect()->route('pembeli.riwayatpesanan')->with('success', 'Produk telah berhasil dipesan. Menunggu konfirmasi pesanan!');
        }
    }

    public function riwayatpesanan(){
        $pesanan = Pesanan::leftjoin('users', 'users.id','=', 'pesanans.user_id')
        ->select('pesanans.*', 'users.name')
        ->where('user_id', 1)->where('status','!=', 'Keranjang')->get();
        return view('pembeli.riwayatpesanan',[
            'pesanan'=>$pesanan
        ]);
    }

    public function batalkanpesanan(Request $request, $id){
        $pesanan = Pesanan::where('kode', $id)->first();

        $pesanan->update([
            'status' => "Dibatalkan"
        ]);

        return back()->with('success', 'Pesanan berhasil Dibatalkan');
    }

    public function detailpesanan($kode){
        $pesanan = Pesanan::where('kode', $kode)->first();
        $detail_pes = DetailPesanan::join('produk','produk.id_produk','=', 'pesanandetails.produk_id')
        ->where('pesanan_id', $pesanan->id)->select('pesanandetails.*', 'produk.gambar_produk', 'produk.nama_produk')->get();
        return view('pembeli.detailpesanan',[
            'detail_pes' => $detail_pes,
            'pesanan' => $pesanan
        ]);
    }


    //admin

    public function konfirmasipesanan(){
        $pesanan = Pesanan::join('users','users.id','=', 'pesanans.user_id')
        ->select('pesanans.*', 'users.name')
        ->where('pesanans.status', "Menunggu")
        ->orderBy('pesanans.tanggal', "DESC")->get();
        return view('admin.konfirmasipesanan',[
            'pesanan'=> $pesanan
        ]);
    }

    public function proseskonfirmasi($id){
        $proseskonfirmasi = Pesanan::where('kode', $id)->first();
        $proseskonfirmasi->update([
            'status' => "Diproses"
        ]);

        return back()->with('success', 'Pesanan berhasil Dikonfirmasi. Pesanan Sedang Diproses');
    }

    public function pembatalan(Request $request, $id){
        $pesanan =  Pesanan::where('kode', $id)->first();
        $pesanan->update([
            'alasan' => $request->alasan,
            'status' => "Dibatalkan"
        ]);

        return back()->with('success', 'Pesanan berhasil Dibatalkan');
    }

    public function pesanandiproses(){
        $pesanan = Pesanan::join('users','users.id','=', 'pesanans.user_id')
        ->select('pesanans.*', 'users.name')
        ->where('pesanans.status', "Diproses")
        ->orderBy('pesanans.tanggal', "DESC")->get();
        return view('admin.pesanandiproses',[
            'pesanan'=>$pesanan
        ]);
    }

    public function prosesselesai($id){
        $proseskonfirmasi = Pesanan::where('kode', $id)->first();
        $proseskonfirmasi->update([
            'status' => "Selesai"
        ]);

        return back()->with('success', 'Pesanan telah Diambil. Pesanan Selesai');
    }

    public function pesananselesai(){
        $pesanan = Pesanan::join('users','users.id','=', 'pesanans.user_id')
        ->select('pesanans.*', 'users.name')
        ->where('pesanans.status', "Selesai")
        ->orderBy('pesanans.tanggal', "DESC")->get();
        return view('admin.pesananselesai',[
            'pesanan' => $pesanan
        ]);
    }

    public function pesanandibatalkan(){
        $pesanan = Pesanan::join('users','users.id','=', 'pesanans.user_id')
        ->select('pesanans.*', 'users.name')
        ->where('pesanans.status', "Dibatalkan")
        ->orderBy('pesanans.tanggal', "DESC")->get();
        return view('admin.pesanandibatalkan',[
            'pesanan' => $pesanan
        ]);
    }

}
