<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AkunController extends Controller
{
     public function __construct()
     {
         $this->middleware(function ($request, $next) {
             if (!Auth::check() || Auth::user()->role !== 'admin') {
                 abort(403, 'Akses ditolak');
             }
             return $next($request);
         });
    }

    public function index()
    {
        $akuns = Akun::latest()->get();
        return view('admin.akun.index', compact('akuns'));
    }

    public function create()
    {
        return view('admin.akun.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:akun,username',
            'password' => 'required|min:6',
        ]);

        Akun::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role'     => 'admin',
        ]);

        return redirect()->route('admin.akun.index')
            ->with('success', 'Akun admin berhasil dibuat');
    }

    public function edit(Akun $akun)
    {
        if ($akun->role !== 'admin') {
            abort(403, 'Akun user tidak bisa diedit');
        }

        return view('admin.akun.edit', compact('akun'));
    }

    public function update(Request $request, Akun $akun)
    {
        if ($akun->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'username' => 'required|unique:akun,username,' . $akun->id,
        ]);

        $data = ['username' => $request->username];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $akun->update($data);

        return redirect()->route('admin.akun.index')
            ->with('success', 'Akun admin berhasil diperbarui');
    }

    public function destroy(Akun $akun)
    {
        if ($akun->role !== 'admin') {
            abort(403);
        }

        $akun->delete();

        return redirect()->route('admin.akun.index')
            ->with('success', 'Akun admin berhasil dihapus');
    }
}
