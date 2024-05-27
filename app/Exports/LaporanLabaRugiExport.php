<?php

namespace App\Exports;

use App\Models\Pesanan;
use App\Models\Produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class LaporanLabaRugiExport implements FromView
{
    private $awal;
    private $akhir;
    public function __construct($awal, $akhir)
    {
        $this->awal = $awal;
        $this->akhir = $akhir;
    }

    public function view(): View
    {
        $detailpes = Pesanan::join('pesanandetails', 'pesanandetails.pesanan_id', '=', 'pesanans.id')
        ->where('pesanans.status', 'Selesai')
            ->whereBetween('pesanans.tanggal', [$this->awal, $this->akhir])->get();

        foreach ($detailpes as $detail) {
            $idProduk[] = $detail->produk_id;
        }

        return view('export.laporanlabarugi', [
            'penjualan' => Produk::whereIn('id_produk', $idProduk)->get()
        ]);
    }
}
