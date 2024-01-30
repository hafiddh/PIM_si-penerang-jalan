<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function postLogin(Request $request)
    {
        // dd($request);
        if (Auth::attempt($request->only('username', 'password'))) {

            if (auth()->user()->level == 1) {
                return \redirect(route('dashboard'));
            } else {
                return \redirect(route('login'));
            }
        } else {
            return \redirect()->back()->with('error', 'Username atau Password Salah!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return \redirect(route('login'))->with('success', 'Anda berhasil logout!');
    }
}
