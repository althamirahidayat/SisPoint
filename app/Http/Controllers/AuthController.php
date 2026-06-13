<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginProcess(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $role = Auth::user()->role;

            return match ($role) {
                'admin' => redirect()->route('dashboard'),
                'siswa' => redirect()->route('dashboard.siswa'),
                'bk' => redirect()->route('dashboard.bk'),
                'walas' => redirect()->route('dashboard.walas'),
                'osis' => redirect()->route('dashboard.osis'),
                'ortu' => redirect()->route('dashboard.ortu'),
                default => redirect()->route('login'),
            };
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }
}