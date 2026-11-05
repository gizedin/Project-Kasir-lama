<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    // Redirect KE LOGIN
    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'username' => ['required', 'string', 'min:6', 'unique:akun,username'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ],
            [
                'username.min' => 'Username minimal 6 karakter',
                'password.min' => 'Password minimal 6 karakter',
                'password.confirmed' => 'Konfirmasi password tidak sama',
            ]
        );
    }

    protected function create(array $data)
    {
        return Akun::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'role'     => 'user',
        ]);
    }

    /**
     * 
     * Matikan auto-login setelah register
     */
    protected function registered($request, $user)
    {
        // pastikan user TIDAK login
        Auth::logout();

        return redirect('/login')
            ->with('status', 'Registrasi berhasil. Silakan login.');
    }
}
