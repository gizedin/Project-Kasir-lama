<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use App\Models\Barang;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DiskonController extends Controller
{
    public function index()
    {
        $diskons = Diskon::with('barang')->latest()->get();
        return view('admin.diskon.index', compact('diskons'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('admin.diskon.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id|unique:diskons,barang_id',
            'tipe'      => 'required|in:persen,nominal',
            'nilai'     => 'required|numeric|min:1',
            'mulai'     => 'required|date',
            'selesai'   => 'required|date|after_or_equal:mulai',
        ]);

        $today = Carbon::today();

        $aktif = $today->between(
            Carbon::parse($request->mulai),
            Carbon::parse($request->selesai)
        );

        Diskon::create([
            'barang_id' => $request->barang_id,
            'tipe'      => $request->tipe,
            'nilai'     => $request->nilai,
            'mulai'     => $request->mulai,
            'selesai'   => $request->selesai,
            'aktif'     => $aktif,
        ]);

        return redirect()->route('admin.diskon.index')
            ->with('success', 'Diskon berhasil ditambahkan');
    }

    public function edit(Diskon $diskon)
    {
        $barangs = Barang::all();
        return view('admin.diskon.edit', compact('diskon', 'barangs'));
    }

    public function update(Request $request, Diskon $diskon)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id|unique:diskons,barang_id,' . $diskon->id,
            'tipe'      => 'required|in:persen,nominal',
            'nilai'     => 'required|numeric|min:1',
            'mulai'     => 'required|date',
            'selesai'   => 'required|date|after_or_equal:mulai',
        ]);

        $today = Carbon::today();

        $aktif = $today->between(
            Carbon::parse($request->mulai),
            Carbon::parse($request->selesai)
        );

        $diskon->update([
            'barang_id' => $request->barang_id,
            'tipe'      => $request->tipe,
            'nilai'     => $request->nilai,
            'mulai'     => $request->mulai,
            'selesai'   => $request->selesai,
            'aktif'     => $aktif,
        ]);

        return redirect()->route('admin.diskon.index')
            ->with('success', 'Diskon berhasil diperbarui');
    }

    public function destroy(Diskon $diskon)
    {
        $diskon->delete();

        return redirect()->route('admin.diskon.index')
            ->with('success', 'Diskon berhasil dihapus');
    }
}
