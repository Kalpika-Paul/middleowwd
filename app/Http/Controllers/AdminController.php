<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {

        return view('dashboard');
    }

    public function auth(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {

            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid Credentials'
        ]);
    }


    public function logout(Request  $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
       
        return redirect()->route('welcome');
    }
}
