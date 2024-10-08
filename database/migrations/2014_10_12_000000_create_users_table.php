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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('jenis_kelamin')->default('Laki-Laki');
            $table->string('pekerjaan')->default('-');
            $table->string('alamat')->default('-');
            $table->string('no_telp')->default('-');
            $table->string('gambar_pengguna')->default('profile.png');
            $table->longText('tentang')->nullable();
            $table->string('email')->unique();
            $table->string('twitter')->default('https://twitter.com/');
            $table->string('facebook')->default('https://facebook.com/');
            $table->string('instagram')->default('https://instagram.com/');
            $table->string('linkedin')->default('https://linkedin.com/');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default('$2y$10$5DNeMBwr01c/PxQDS7I6BOcxxQL5GT7naGt4Bftj5LBGZ4hgb8JO6');
            $table->rememberToken();
            $table->timestamps();
            $table->string("role_pengguna")->default('Publik');
            $table->string('bukti')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
