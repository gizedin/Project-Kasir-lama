<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function __construct()
    {
        // wajib login
        $this->middleware(function ($request, $next) {

            if (!Auth::check()) {
                return redirect()->route('login');
            }

            return $next($request);
        });

        // HANYA ADMIN, KECUALI show
        $this->middleware(function ($request, $next) {

            if (Auth::user()->role !== 'admin') {
                abort(403, 'Akses ditolak');
            }

            return $next($request);
        })->except('show');
    }

    // ================= ADMIN =================

    public function index()
    {
        $barangs = Barang::latest()->get();
        return view('admin.barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('admin.barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namabarang' => 'required|string|max:255',
            'deskripsi'  => 'nullable|string',
            'stok'       => 'required|integer|min:0',
            'harga'      => 'required|integer|min:0',
            'gambar'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('barang', 'public');
        }

        Barang::create([
            'namabarang' => $request->namabarang,
            'deskripsi'  => $request->deskripsi,
            'stok'       => $request->stok,
            'harga'      => $request->harga,
            'gambar'     => $gambar,
        ]);

        return redirect()->route('admin.barang.index')
            ->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit(Barang $barang)
    {
        return view('admin.barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'namabarang' => 'required|string|max:255',
            'deskripsi'  => 'nullable|string',
            'stok'       => 'required|integer|min:0',
            'harga'      => 'required|integer|min:0',
            'gambar'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($barang->gambar) {
                Storage::disk('public')->delete($barang->gambar);
            }
            $barang->gambar = $request->file('gambar')->store('barang', 'public');
        }

        $barang->update([
            'namabarang' => $request->namabarang,
            'deskripsi'  => $request->deskripsi,    
            'stok'       => $request->stok,
            'harga'      => $request->harga,
        ]);

        return redirect()->route('admin.barang.index')
            ->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy(Barang $barang)
    {
        if ($barang->gambar) {
            Storage::disk('public')->delete($barang->gambar);
        }

        $barang->delete();

        return redirect()->route('admin.barang.index')
            ->with('success', 'Barang berhasil dihapus');
    }

    // ================= USER =================

    public function show(Barang $barang)
    {
        if (!in_array(Auth::user()->role, ['admin','user'])) {
            abort(403);
        }

        $barang->load('diskon');

        return view('user.barang.show', compact('barang'));
    }

}
