<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() {
        return view('login');
    }

    public function login() {
        if (auth()->attempt(['username' => request()->username, 'password' => request('password')])) {
            if (auth()->user()->role == 'employee') {
                return redirect()->route('vehicle-request');
            }
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('error', 'Username or Password is Wrong');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login-index');
    }
}
