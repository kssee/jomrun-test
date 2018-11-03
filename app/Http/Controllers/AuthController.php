<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        $user = User::first();
        auth()->login($user);
        return redirect()->route('home');
    }

    public function signup()
    {

    }

    public function logout()
    {

    }
}
