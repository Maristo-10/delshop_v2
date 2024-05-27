<?php

namespace App\Exports;

use App\Models\Pesanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class LaporanPenjualanExport implements FromView
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

        return view('export.laporanpenjualan', [
            'pesanan' => Pesanan::whereBetween('tanggal',[$this->awal , $this->akhir])->where('status', 'Selesai')->get()
        ]);
    }
}
