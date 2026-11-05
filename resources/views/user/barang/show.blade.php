<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $barang->namabarang }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body { background:#f5f5f5; }

    .container {
        max-width: 100% !important;
        padding-left: 12px;
        padding-right: 12px;
    }

    /* ==== Gambar lebih lebar ==== */
    .product-img-wrapper {
        width: 100%;
        max-width: 1000px;      /* DARI 350px → 480px (LEBIH LEBAR) */
        margin: 0 auto;
    }

    .product-img {
        width:100%;
        height:360px;          /* DARI 320px → 360px (PROPORSI BAGUS) */
        object-fit:cover;
        border-radius:12px;
    }

    .card-box {
        background:#fff;
        border-radius:12px;
        padding:16px;
        box-shadow:0 1px 4px rgba(0,0,0,.05);
    }

    .price {
        font-size:1.7rem;
        font-weight:700;
        color:#28a745;
    }

    .btn-buy {
        height:45px;
        font-weight:600;
        border-radius:10px;
    }

        @media (max-width:480px) {
            .product-img {
                height:260px;   /* LEBIH KECIL DI HP */
            }
        }
    </style>
</head>
<body>

@php
    $diskon = $barang->diskon;
    $hargaAsli = $barang->harga;
    $hargaFinal = $diskon
        ? ($diskon->tipe === 'persen'
            ? $hargaAsli - ($hargaAsli * $diskon->nilai / 100)
            : $hargaAsli - $diskon->nilai)
        : $hargaAsli;
@endphp

<div class="container py-3">

    <!-- GAMBAR PRODUK (LEBIH KECIL) -->
    <div class="product-img-wrapper mb-3">
        <img src="{{ $barang->gambar ? asset('storage/'.$barang->gambar) : 'https://via.placeholder.com/600x600' }}"
             class="product-img">
    </div>

    <!-- INFORMASI -->
    <div class="card-box mb-3">
        <h5 class="fw-bold">{{ $barang->namabarang }}</h5>

        @if($diskon)
            <small class="text-muted text-decoration-line-through">
                Rp {{ number_format($hargaAsli,0,',','.') }}
            </small>
        @endif

        <div class="price">
            Rp {{ number_format($hargaFinal,0,',','.') }}
        </div>

        <p class="mt-2 mb-1">{{ $barang->deskripsi ?? '-' }}</p>

        <p><strong>Stok:</strong> {{ $barang->stok }}</p>
    </div>

    <!-- BELI -->
    <div class="card-box">
        @if($barang->stok > 0)
            <form method="POST" action="{{ route('user.transaksi.bayar') }}">
                @csrf
                <input type="hidden" name="barang_id" value="{{ $barang->id }}">

                <button type="submit" class="btn btn-success w-100 btn-buy">
                    Beli Sekarang
                </button>
            </form>
        @else
            <button class="btn btn-secondary w-100 btn-buy" disabled>
                Stok Habis
            </button>
        @endif

        <a href="{{ route('home') }}" class="btn btn-light w-100 mt-2">
            Kembali
        </a>
    </div>

</div>

</body>
</html>
