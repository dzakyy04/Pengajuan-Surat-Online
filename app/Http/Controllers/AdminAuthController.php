<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::guard('admin')->attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::guard('admin')->user();

        if ($user->role === 'kades') {
            return redirect()->route('admin.arsip.index');
        }

        return redirect()->route('admin.dashboard');
    }

    return back()->with('error', 'Email atau password salah');
}


    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('status', 'Anda sudah keluar.');
    }
}
