<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriProdukModel extends Model
{
    protected $table = "kategoriproduk";
    protected $fillable = ['kategori','gambar_kategori'];
}
