<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Barang;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Optional dashboard
     */
    public function index()
    {
        return view('dashboard');
    }

    /**
     * HOME USER – LIST BARANG + DISKON
     */
    public function home()
    {
        $barangs = Barang::with('diskon')
            ->latest()
            ->get();

        return view('home', compact('barangs'));
    }
}
