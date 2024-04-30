<?php

namespace App\Http\Controllers;

use App\Models\KategoriProdukModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function dash_pembeli(){
        $kategori_produk = KategoriProdukModel::where('status_kategori','Aktif')->get();
        return view('home.dashboard_pembeli',[
            'kategori_produk' => $kategori_produk,
        ]);
    }

}
