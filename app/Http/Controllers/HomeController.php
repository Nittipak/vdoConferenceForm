<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __invoke()
    {
            return view('admin.layouts.app');
        // $role=Auth::user()->role;
    
        // if($role=='1'){
        //     return view('admin.layouts.app');
        // }else{
        //     return view('dashboard');
        // }
    }
}
