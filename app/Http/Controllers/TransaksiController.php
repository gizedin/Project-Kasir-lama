<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * =======================
     * ADMIN - LIST TRANSAKSI
     * GET /transaksi
     * =======================
     */
    public function index()
    {
        // ✅ pastikan admin (opsional, sesuaikan role kamu)
        // if (Auth::user()->role !== 'admin') {
        //     abort(403, 'Akses ditolak');
        // }

        $transaksis = Transaksi::with(['barang'])
            ->latest()
            ->get();

        return view('admin.transaksi.index', compact('transaksis'));
    }

    /**
     * =======================
     * USER - HALAMAN BAYAR
     * POST /transaksi/bayar
     * =======================
     */
    public function bayar(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
        ]);

        $barang = Barang::with('diskon')->findOrFail($request->barang_id);

        return view('user.transaksi.bayar', compact('barang'));
    }

    /**
     * =======================
     * USER - SIMPAN TRANSAKSI
     * POST /transaksi/store
     * =======================
     */
    public function store(Request $request)
    {
        $akun = Auth::user(); // MODEL AKUN

        $request->validate([
            'barang_id'   => 'required|exists:barangs,id',
            'qty'         => 'required|integer|min:1',
            'harga_asli'  => 'required|numeric|min:0',
            'diskon'      => 'required|numeric|min:0',
            'harga_final' => 'required|numeric|min:0',
            'payment'     => 'required|in:cash,transfer,ewallet',
        ]);

        DB::beginTransaction();

        try {
            // lock stok
            $barang = Barang::lockForUpdate()->findOrFail($request->barang_id);

            if ($request->qty > $barang->stok) {
                DB::rollBack();
                return back()->withErrors([
                    'qty' => 'Stok tidak mencukupi',
                ]);
            }

            $transaksi = Transaksi::create([
                'user_id'     => $akun->id,
                'barang_id'   => $barang->id,
                'qty'         => $request->qty,
                'harga_asli'  => $request->harga_asli,
                'diskon'      => $request->diskon,
                'harga_final' => $request->harga_final,
                'payment'     => $request->payment,
                'status'      => 'success',
            ]);

            $barang->decrement('stok', $request->qty);

            DB::commit();

            return redirect()
                ->route('user.transaksi.struk', $transaksi->id)
                ->with('success', 'Transaksi berhasil');

        } catch (\Throwable $e) {
            DB::rollBack();
            abort(500, 'Terjadi kesalahan saat memproses transaksi');
        }
    }

    /**
     * =======================
     * USER - STRUK TRANSAKSI
     * GET /transaksi/{id}/struk
     * =======================
     */
    public function struk($id)
    {
        $transaksi = Transaksi::with('barang')->findOrFail($id);

        if ($transaksi->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak');
        }

        return view('user.transaksi.struk', compact('transaksi'));
    }
}
