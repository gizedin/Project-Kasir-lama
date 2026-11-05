@extends('layouts.app')

@section('title','Manajemen Diskon')

@push('styles')
<link rel="stylesheet"
      href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

<style>
    /* Wadah table agar tidak overflow di HP */
    .table-responsive-mobile {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    /* Supaya teks tidak kepanjangan */
    table td {
        white-space: nowrap;
    }

    /* Tombol lebih kecil khusus mobile */
    @media (max-width: 576px) {
        .btn-sm-mobile {
            padding: 4px 6px !important;
            font-size: 11px !important;
        }
        table td {
            white-space: normal !important; 
            word-break: break-word;
        }
    }
</style>
@endpush

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between mb-3">
        <h4 class="fw-bold">Manajemen Diskon</h4>
        <a href="{{ route('admin.diskon.create') }}" class="btn btn-primary">
            + Tambah Diskon
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive-mobile">
        <table class="table table-bordered" id="diskonTable">
            <thead class="table-light text-center">
            <tr>
                <th>No</th>
                <th>Barang</th>
                <th>Tipe</th>
                <th>Nilai</th>
                <th>Mulai</th>
                <th>Selesai</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($diskons as $diskon)
            <tr class="text-center">
                <td>{{ $loop->iteration }}</td>
                <td class="text-start">{{ $diskon->barang->namabarang }}</td>
                <td>{{ strtoupper($diskon->tipe) }}</td>
                <td>{{ $diskon->nilai }}</td>
                <td>{{ $diskon->mulai->format('d-m-Y') }}</td>
                <td>{{ $diskon->selesai->format('d-m-Y') }}</td>
                <td>
                    <span class="badge {{ $diskon->aktif ? 'bg-success' : 'bg-secondary' }}">
                        {{ $diskon->aktif ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.diskon.edit', $diskon->id) }}"
                       class="btn btn-warning btn-sm btn-sm-mobile">Edit</a>

                    <form action="{{ route('admin.diskon.destroy',$diskon->id) }}"
                          method="POST" class="d-inline"
                          onsubmit="return confirm('Hapus diskon?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm btn-sm-mobile">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script>
$(function () {
    $('#diskonTable').DataTable({
        order: [[0,'desc']],
        columnDefs: [{ orderable:false, targets:[7] }]
    });
});
</script>
@endpush
