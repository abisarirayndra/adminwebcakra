<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    public function beranda(){
        $user = Auth::user()->nama;
        return view('admin.beranda', compact('user'));
    }
}
