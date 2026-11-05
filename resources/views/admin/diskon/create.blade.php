@extends('layouts.app')

@section('title', 'Tambah Diskon')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-4">Tambah Diskon</h4>

    <form action="{{ route('admin.diskon.store') }}" method="POST">
        @csrf

        <div class="card shadow-sm border-0">
            <div class="card-body">

                {{-- BARANG --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Barang</label>
                    <select name="barang_id" class="form-select" required>
                        <option value="">-- Pilih Barang --</option>
                        @foreach($barangs as $barang)
                            <option value="{{ $barang->id }}"
                                {{ old('barang_id') == $barang->id ? 'selected' : '' }}>
                                {{ $barang->namabarang }}
                            </option>
                        @endforeach
                    </select>
                    @error('barang_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- TIPE & NILAI --}}
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Tipe Diskon</label>
                        <select name="tipe" class="form-select" required>
                            <option value="persen" {{ old('tipe')=='persen'?'selected':'' }}>
                                Persentase (%)
                            </option>
                            <option value="nominal" {{ old('tipe')=='nominal'?'selected':'' }}>
                                Nominal (Rp)
                            </option>
                        </select>
                        @error('tipe')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-8 mb-3">
                        <label class="form-label fw-semibold">Nilai Diskon</label>
                        <input type="number"
                               name="nilai"
                               class="form-control"
                               min="1"
                               value="{{ old('nilai') }}"
                               required>
                        @error('nilai')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- PERIODE --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tanggal Mulai</label>
                        <input type="date"
                               name="mulai"
                               class="form-control"
                               value="{{ old('mulai') }}"
                               required>
                        @error('mulai')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tanggal Selesai</label>
                        <input type="date"
                               name="selesai"
                               class="form-control"
                               value="{{ old('selesai') }}"
                               required>
                        @error('selesai')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- INFO STATUS --}}
                <div class="alert alert-info mt-2">
                    <small>
                        Status <b>Aktif / Tidak Aktif</b> akan ditentukan otomatis
                        berdasarkan tanggal mulai & selesai.
                    </small>
                </div>

            </div>

            <div class="card-footer bg-white text-end">
                <a href="{{ route('admin.diskon.index') }}"
                   class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">
                    Simpan Diskon
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
