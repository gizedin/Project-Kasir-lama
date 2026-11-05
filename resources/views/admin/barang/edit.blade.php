@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h4>Edit Barang</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.barang.update', $barang->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Barang</label>
                    <input type="text"
                           name="namabarang"
                           class="form-control"
                           value="{{ old('namabarang', $barang->namabarang) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi"
                              class="form-control"
                              rows="3">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar</label><br>
                    @if($barang->gambar)
                        <img src="{{ asset('storage/'.$barang->gambar) }}"
                             width="100"
                             class="mb-2 rounded">
                    @endif
                    <input type="file"
                           name="gambar"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number"
                           name="stok"
                           class="form-control"
                           value="{{ old('stok', $barang->stok) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number"
                           name="harga"
                           class="form-control"
                           value="{{ old('harga', $barang->harga) }}"
                           required>
                </div>

                <button class="btn btn-success">Update</button>
                <a href="{{ route('admin.barang.index') }}"
                   class="btn btn-secondary">
                   Kembali
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
