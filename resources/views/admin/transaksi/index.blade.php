@extends('layouts.app')

@section('title', 'Data Transaksi')

@push('styles')
<link rel="stylesheet"
      href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

<style>
    /* === RESPONSIVE TABEL KHUSUS MOBILE === */
    @media (max-width: 576px) {
        .table-responsive-mobile {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        table#transaksiTable th,
        table#transaksiTable td {
            white-space: nowrap;     /* cegah pecah baris */
            padding: 6px 10px;
            font-size: 13px;
        }
    }
</style>
@endpush

@section('content')
<div class="container py-4">
    <h4 class="fw-bold mb-3">Data Transaksi</h4>

    <div class="card shadow-sm">
        <div class="card-body table-responsive-mobile">

            <table id="transaksiTable" class="table table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Pembeli</th>
                        <th>Barang</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Pembayaran</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($transaksis as $item)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>

                        {{-- USER / AKUN --}}
                        <td class="text-start">
                            {{ $item->akun->username ?? '-' }}
                        </td>

                        {{-- BARANG --}}
                        <td class="text-start">
                            {{ $item->barang->namabarang ?? '-' }}
                        </td>

                        {{-- QTY --}}
                        <td>{{ $item->qty }}</td>

                        {{-- TOTAL --}}
                        <td class="text-end">
                            Rp {{ number_format($item->harga_final,0,',','.') }}
                        </td>

                        {{-- PAYMENT --}}
                        <td>{{ strtoupper($item->payment) }}</td>

                        {{-- STATUS --}}
                        <td>
                            <span class="badge {{ $item->status === 'success' ? 'bg-success' : 'bg-danger' }}">
                                {{ strtoupper($item->status) }}
                            </span>
                        </td>

                        {{-- TANGGAL --}}
                        <td>
                            {{ $item->created_at->format('d-m-Y H:i') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script>
$(function () {
    $('#transaksiTable').DataTable({
        order: [[7, 'desc']],
        columnDefs: [
            { orderable:false, targets:[0] }
        ],
        scrollX: true    // supaya tetap enak dilihat di mobile
    });
});
</script>
@endpush
