<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Alert;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function log(Request $request){
        $logintype = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'nomor_registrasi';

        $credentials = [
            $logintype => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($credentials)){

            if(auth()->user()->role_id == 1){
                Alert::toast('Selamat Datang Master', 'success');
                return redirect()->route('super.index');
            }

        Alert::error('Akun tidak ditemukan','Gagal');
        return redirect()->route('login');
        }
    }

    public function logout(){
        Auth::logout();
        Alert::success('Kamu berhasil keluar', 'Selamat tinggal!');
        return redirect()->route('login');
    }
}
