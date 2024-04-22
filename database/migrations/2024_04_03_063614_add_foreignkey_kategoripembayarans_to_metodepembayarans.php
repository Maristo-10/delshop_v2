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
        Schema::table('metodepembayarans', function (Blueprint $table) {
            $table->foreign("kategori_layanan")->references("id_kapem")->on("kategoripembayarans")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('metodepembayarans', function (Blueprint $table) {
            //
        });
    }
};
