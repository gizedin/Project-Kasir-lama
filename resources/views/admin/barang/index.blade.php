@extends('layouts.app')

@section('title', 'Data Barang')

@push('styles')
<link rel="stylesheet"
      href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
@endpush

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Data Barang</h4>
        <a href="{{ route('admin.barang.create') }}" class="btn btn-primary">
            + Tambah Barang
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <table class="table table-bordered table-hover align-middle" id="barangTable">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barangs as $barang)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-start">{{ $barang->namabarang }}</td>
                            <td class="text-start">{{ $barang->deskripsi ?? '-' }}</td>
                            <td>
                                <img src="{{ $barang->gambar
                                    ? asset('storage/'.$barang->gambar)
                                    : 'https://via.placeholder.com/80' }}"
                                    width="60" class="rounded">
                            </td>
                            <td>{{ $barang->stok }}</td>
                            <td>Rp {{ number_format($barang->harga,0,',','.') }}</td>
                            <td>
                                <a href="{{ route('admin.barang.edit',$barang->id) }}"
                                   class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.barang.destroy',$barang->id) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin hapus?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
<style>
/* === RESPONSIVE KHUSUS MOBILE === */
@media (max-width: 768px) {

    /* kecilkan teks tabel */
    #barangTable {
        font-size: 11px !important;
    }

    #barangTable th,
    #barangTable td {
        padding: 6px !important;
    }

    /* kecilkan gambar */
    #barangTable img {
        width: 40px !important;
        height: auto !important;
    }

    /* kolom nama & deskripsi biar tidak kepanjangan */
    #barangTable td:nth-child(2),
    #barangTable td:nth-child(3) {
        max-width: 120px;
        white-space: normal !important;
        word-wrap: break-word;
        font-size: 11px;
        text-align: left;
    }

    /* tombol aksi biar lebih kecil */
    #barangTable .btn {
        padding: 3px 6px !important;
        font-size: 10px !important;
    }

    /* table wrapper biar tidak geser */
    .dataTables_wrapper {
        overflow-x: auto;
    }
}
</style>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function () {
    $('#barangTable').DataTable({
        pageLength: 10,
        columnDefs: [
            { orderable: false, targets: [3, 6] }
        ],
        language: {
            search: "Cari Barang:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            paginate: {
                previous: "‹",
                next: "›"
            }
        }
    });
});
</script>
@endpush
