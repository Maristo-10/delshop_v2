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
        Schema::create('kategoriproduk', function (Blueprint $table) {
            $table->string("kategori")->primary();
            $table->string('gambar_kategori')->nullable();
            $table->string("status_kategori")->default("Aktif");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategoriproduk');
    }
};
