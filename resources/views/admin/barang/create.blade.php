@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h4>Tambah Barang</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.barang.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Barang</label>
                    <input type="text"
                           name="namabarang"
                           class="form-control"
                           value="{{ old('namabarang') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi"
                              class="form-control"
                              rows="3">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    <input type="file"
                           name="gambar"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number"
                           name="stok"
                           class="form-control"
                           value="{{ old('stok') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number"
                           name="harga"
                           class="form-control"
                           value="{{ old('harga') }}"
                           required>
                </div>

                <button class="btn btn-success">Simpan</button>
                <a href="{{ route('admin.barang.index') }}"
                   class="btn btn-secondary">
                   Kembali
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
