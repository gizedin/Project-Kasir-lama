<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>Struk Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
        }

        .container {
            max-width: 100% !important;
            padding: 15px;
        }

        .card {
            border-radius: 14px;
        }

        .card-header {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .card-body p {
            margin-bottom: 6px;
        }

        .badge {
            padding: 8px 14px;
            font-size: 0.9rem;
        }

        @media(max-width:480px) {
            .col-md-6 {
                width: 100%;
            }
            .card-body {
                padding: 18px;
            }
        }
    </style>
</head>

<body>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow border-0">
                <div class="card-header bg-dark text-white text-center">
                    Struk Pembayaran
                </div>

                <div class="card-body">

                    <p><strong>Kode :</strong> #TRX{{ $transaksi->id }}</p>

                    <p><strong>Barang :</strong> {{ $transaksi->barang->namabarang }}</p>

                    <p><strong>Qty :</strong> {{ $transaksi->qty }}</p>

                    <p><strong>Total :</strong>
                        Rp {{ number_format($transaksi->harga_final,0,',','.') }}
                    </p>

                    <p><strong>Pembayaran :</strong> {{ strtoupper($transaksi->payment) }}</p>

                    <span class="badge bg-success">SUCCESS</span>

                    <hr>

                    <a href="{{ route('home') }}" class="btn btn-primary w-100">
                        Kembali ke Home
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
