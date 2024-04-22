<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pesanandetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('jumlah');
            $table->integer('jumlah_harga');
            $table->float("modal_details")->default(0);
            $table->timestamps();

            $table->unsignedBigInteger('produk_id');
            $table->unsignedBigInteger('pesanan_id');
            $table->string("ukurans")->nullable();
            $table->string("warna_produk")->nullable();
            $table->string("angkatans")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanandetails');
    }
};
