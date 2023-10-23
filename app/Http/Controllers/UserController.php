<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::latest()->get();

        return $users;
    }

    public function store()
    {
        // request()->validate([
        //     'name' => 'required',
        //     'email' => 'required|unique:users,email',
        //     'password' => 'required|min:8',
        // ]);

        return User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
        ]);
    }
}
