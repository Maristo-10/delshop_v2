<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::LOGIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'bukti_pengguna' => ['nullable','mimes:jpg,png', 'max:2048']
            ],
            [
                'email.unique' => 'Email sudah digunakan. Silakan gunakan email lain.',
                'password.confirmed' => 'Kata sandi konfirmasi tidak sesuai.'
            ],
            [
                'no_telp.unique' => 'Nomor Telepon sudah digunakan. Silakan gunakan nomor lain.',
                'password.confirmed' => 'Kata sandi konfirmasi tidak sesuai.'
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data){
        if($data['role_pengguna'] == "Publik"){
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'no_telp' =>$data['no_telp'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'role_pengguna' => $data['role_pengguna'],
            ]);
        }else{
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'no_telp' =>$data['no_telp'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'role_pengguna' => $data['role_pengguna'],
                'bukti' => $data['bukti_pengguna']
            ]);
        }
    }

    public function registered(Request $request, $user) {
        return redirect('/login')->with('success', 'Registrasi Berhasil!');
    }
}
