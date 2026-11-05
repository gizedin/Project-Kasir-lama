<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Akun;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // gunakan username bukan email
    public function username()
    {
        return 'username';
    }

    // redirect setelah login
    protected function redirectTo()
    {
        $user = Auth::user();

        if ($user && $user->role === 'admin') {
            return '/dashboard';
        }

        return '/home';
    }

    // validasi login
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    }

    // pesan error TERPISAH
    protected function sendFailedLoginResponse(Request $request)
    {
        $akun = Akun::where('username', $request->username)->first();

        if (!$akun) {
            return back()->withErrors([
                'username' => 'Username tidak ditemukan',
            ]);
        }

        return back()->withErrors([
            'password' => 'Password salah',
        ]);
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
