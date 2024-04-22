<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriProdukModel extends Model
{
    protected $table = "kategoriproduk";
    protected $primaryKey = 'kategori';
    protected $keyType = 'string';
    protected $fillable = ['kategori','gambar_kategori','status_kategori'];
}
