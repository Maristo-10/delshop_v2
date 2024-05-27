<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $isExistingUser = User::where('email', $row['email'])->first();
        if ($isExistingUser) {
            Session::flash('error', 'Data Sudah Terdaftar!');
            return null;
        }
        return new User([
            'name' => $row['nama'],
            'email' => $row['email'],
            'role_pengguna' => $row['role_pengguna']
        ]);
    }
}
