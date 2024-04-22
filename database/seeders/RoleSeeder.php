<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'role'=> "Admin",
            "kategori_role"=> "Administrator",
        ]);

        DB::table('roles')->insert([
            'role'=> "Pegawai",
            "kategori_role"=> "Administrator",
        ]);

        DB::table('roles')->insert([
            'role'=> "Mahasiswa",
            "kategori_role"=> "Pembeli",
        ]);

        DB::table('roles')->insert([
            'role'=> "Publik",
            "kategori_role"=> "Pembeli",
        ]);

        DB::table('roles')->insert([
            'role'=> "Dosen/Staff",
            "kategori_role"=> "Pembeli",
        ]);
    }
}
