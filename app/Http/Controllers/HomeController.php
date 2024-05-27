<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard(){
        $produk_terjual = DetailPesanan::join('pesanans','pesanans.id','=', 'pesanandetails.pesanan_id')->where('pesanans.status', 'Selesai')->sum('pesanandetails.jumlah');
        $pesanan = Pesanan::where('status', 'Selesai')->get();

        $untung =0;

        foreach($pesanan as $pes){
            $laba = $pes->total_harga - $pes->modal_pesanan;
            $untung += $laba;
        }

        $pengguna = User::count();

         //Data statistik
         DB::statement("SET SQL_MODE=''");
         $now = Carbon::now();
         // dd($now);
         $bulan = Pesanan::select(DB::raw('MonthName(tanggal) as bulanp'))
             ->GroupBy(DB::raw('MonthName(tanggal)'))->OrderBy('tanggal', 'ASC')->whereYear('tanggal', $now)->pluck('bulanp');

         $totalpemasukan = Pesanan::select("total_harga", DB::raw('CAST(SUM(total_harga) as UNSIGNED INTEGER ) as totalp'))
             ->groupBy(DB::raw('MonthName(tanggal)'))->OrderBy('tanggal', 'ASC')
             ->whereYear('tanggal', $now)->where('pesanans.status', 'Selesai')->pluck('totalp');

         $totalproduk = DB::table('pesanans')->select(DB::raw('CAST(count(id) as UNSIGNED INTEGER ) as totalpr'))->groupBy(DB::raw('MonthName(tanggal)'))->OrderBy('tanggal', 'ASC')->whereYear('tanggal', $now)->where('pesanans.status', 'Selesai')->pluck('totalpr');

         $tahun = $now->format('Y');
         $date = $now->format('l, d F Y');

        return view('home.dashboard_admin',[
            'produk_terjual' => $produk_terjual,
            'untung' => $untung,
            'pengguna' => $pengguna,
            'bulan'=>$bulan,
            'totalpemasukan' => $totalpemasukan,
            'totalproduk' => $totalproduk,
            'tahun' => $tahun,
            'date' => $date
        ]);
    }
}
