<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLogin;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->method() == 'POST') {
            $inputs = $request->validate(['email' => 'required', 'password' => 'required']);
            if (auth()->attempt($inputs)) {
                $this->add_login_log($request->getClientIp());

                return redirect()->intended('/');
            } else {
                return redirect()->back()->withInput()->withErrors('Incorrect email or password.');
            }
        } else {
            return view('login');
        }
    }

    public function signup(Request $request)
    {
        if (auth()->check()) {
            return redirect()->intended('/');
        }
        if ($request->method() == 'POST') {
            $inputs = $request->validate(['name' => 'nullable', 'email' => 'required|email', 'password' => 'required']);
            $checkExisting = User::where('email', $inputs['email'])->first();
            if ($checkExisting) {
                return redirect()->back()->withInput()->withErrors('Email exists, please register with another email.');
            }

            $user = new User();
            $user->name = $request->get('name', $inputs['email']);
            $user->email = $inputs['email'];
            $user->password = bcrypt($inputs['password']);
            $user->save();

            auth()->login($user);
            $this->add_login_log($request->getClientIp());

            return redirect()->intended('/');
        } else {
            return view('register');
        }
    }

    public function logout()
    {
        if (auth()->check()) {
            auth()->logout();
        }

        return redirect()->route('home');
    }

    private function add_login_log($ip)
    {
        if (auth()->check()) {
            $login_log = new UserLogin();
            $login_log->user_id = auth()->user()->id;
            $login_log->ip = $ip;
            $login_log->save();
        }
    }
}
