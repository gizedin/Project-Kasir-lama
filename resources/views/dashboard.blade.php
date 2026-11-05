@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <!-- Header -->
    <div class="row mb-4">
        <div class="col">
            <div class="p-4 p-md-4 p-sm-3 rounded text-white"
                 style="background: linear-gradient(135deg, #4e73df, #1cc88a);">
                <h4 class="mb-1 fw-bold">Dashboard</h4>
                <small>Selamat datang kembali 👋</small>
            </div>
        </div>
    </div>

    <!-- Alert -->
    @if (session('status'))
        <div class="alert alert-success shadow-sm">
            ✅ {{ session('status') }}
        </div>
    @endif

    <!-- Info Cards -->
    <div class="row g-4">

        <!-- Barang -->
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 fs-1 fs-md-1 fs-sm-3">📦</div>
                    <div>
                        <h6 class="mb-0 fw-semibold">Total Barang</h6>
                        <small class="text-muted">Kelola stok barang</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaksi -->
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 fs-1">💳</div>
                    <div>
                        <h6 class="mb-0 fw-semibold">Transaksi</h6>
                        <small class="text-muted">Riwayat pembelian</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Diskon -->
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 fs-1">🏷️</div>
                    <div>
                        <h6 class="mb-0 fw-semibold">Diskon Aktif</h6>
                        <small class="text-muted">Atur promo & potongan</small>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer text -->
    <div class="row mt-5">
        <div class="col text-center text-muted">
            Anda sudah login dan siap mengelola sistem ✅
        </div>
    </div>

</div>

<!-- MOBILE OPTIMIZATION -->
<style>
    /* Khusus tampilan HP */
    @media (max-width: 768px) {

        /* Header shrink */
        .rounded h4 {
            font-size: 18px;
        }

        .rounded small {
            font-size: 12px;
        }

        /* Card icon kecil */
        .card-body .fs-1 {
            font-size: 35px !important;
        }

        .card-body h6 {
            font-size: 14px;
        }

        .card-body small {
            font-size: 12px;
        }

        .container {
            padding-left: 8px !important;
            padding-right: 8px !important;
        }
    }
</style>

@endsection
