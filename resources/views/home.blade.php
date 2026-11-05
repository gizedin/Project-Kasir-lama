<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark"
     style="background: linear-gradient(90deg,#4e73df,#1cc88a);">
    <div class="container">
        <span class="navbar-brand fw-bold">App</span>

        <div class="ms-auto d-flex align-items-center gap-3 text-white">
            Halo, <b>{{ auth()->user()->username }}</b>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-sm btn-light">Logout</button>
            </form>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="py-5 bg-white text-center border-bottom">
    <div class="container">
        <h3 class="fw-bold">Produk Terbaru</h3>
        <p class="text-muted">Dapatkan harga terbaik hari ini</p>
    </div>
</section>

<!-- LIST BARANG -->
<div class="container py-5">
    <div class="row g-4">

        @forelse ($barangs as $barang)
            @php
                $diskon = $barang->diskon;
                $hargaAsli = $barang->harga;

                if ($diskon) {
                    $hargaFinal = $diskon->tipe === 'persen'
                        ? $hargaAsli - ($hargaAsli * $diskon->nilai / 100)
                        : $hargaAsli - $diskon->nilai;
                }
            @endphp

            <div class="col-md-4 col-sm-6">
                <div class="card h-100 border-0 shadow-sm">

                    <img src="{{ $barang->gambar
                        ? asset('storage/'.$barang->gambar)
                        : 'https://via.placeholder.com/400x300' }}"
                        class="card-img-top"
                        style="height:220px;object-fit:cover">

                    <div class="card-body d-flex flex-column">
                        <h6 class="fw-semibold mb-1">
                            {{ $barang->namabarang }}
                        </h6>

                        <p class="text-muted small">
                            {{ Str::limit($barang->deskripsi, 60) }}
                        </p>

                        <!-- HARGA -->
                        <div class="mb-2">
                            @if($diskon)
                                <span class="text-muted text-decoration-line-through small">
                                    Rp {{ number_format($hargaAsli,0,',','.') }}
                                </span>

                                <div class="fw-bold text-success">
                                    Rp {{ number_format($hargaFinal,0,',','.') }}
                                </div>

                                <span class="badge bg-danger">
                                    Diskon
                                    {{ $diskon->tipe === 'persen'
                                        ? $diskon->nilai.'%'
                                        : 'Rp '.number_format($diskon->nilai,0,',','.') }}
                                </span>
                            @else
                                <span class="fw-bold text-success">
                                    Rp {{ number_format($hargaAsli,0,',','.') }}
                                </span>
                            @endif
                        </div>

                        <small class="text-muted mb-3">
                            Stok: {{ $barang->stok }}
                        </small>

                        <a href="{{ route('user.barang.show', $barang->id) }}"
                           class="btn btn-primary mt-auto">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col text-center text-muted">
                Barang belum tersedia
            </div>
        @endforelse

    </div>
</div>

<footer class="bg-white border-top py-4 text-center">
    <small class="text-muted">© 2025 App</small>
</footer>

</body>
</html>
