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
        Schema::create('metodepembayarans', function (Blueprint $table) {
            $table->increments('id_metpem');
            $table->string('status_metpem')->default('Aktif');
            $table->string('layanan');
            $table->string('no_layanan');
            $table->string('nama_pemilik');
            $table->unsignedInteger('kategori_layanan');
            $table->string('kapem')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metodepembayarans');
    }
};
