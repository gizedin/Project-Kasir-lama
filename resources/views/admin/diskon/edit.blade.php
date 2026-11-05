@extends('layouts.app')

@section('title', 'Edit Diskon')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-4">Edit Diskon</h4>

    <form action="{{ route('admin.diskon.update', $diskon->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card shadow-sm border-0">
            <div class="card-body">

                {{-- BARANG --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Barang</label>
                    <select name="barang_id" class="form-select" required>
                        @foreach($barangs as $barang)
                            <option value="{{ $barang->id }}"
                                {{ $diskon->barang_id == $barang->id ? 'selected' : '' }}>
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
                            <option value="persen" {{ $diskon->tipe=='persen'?'selected':'' }}>
                                Persentase (%)
                            </option>
                            <option value="nominal" {{ $diskon->tipe=='nominal'?'selected':'' }}>
                                Nominal (Rp)
                            </option>
                        </select>
                    </div>

                    <div class="col-md-8 mb-3">
                        <label class="form-label fw-semibold">Nilai Diskon</label>
                        <input type="number"
                               name="nilai"
                               class="form-control"
                               min="1"
                               value="{{ $diskon->nilai }}"
                               required>
                    </div>
                </div>

                {{-- TANGGAL --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tanggal Mulai</label>
                        <input type="date"
                               name="mulai"
                               class="form-control"
                               value="{{ $diskon->mulai->format('Y-m-d') }}"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tanggal Selesai</label>
                        <input type="date"
                               name="selesai"
                               class="form-control"
                               value="{{ $diskon->selesai->format('Y-m-d') }}"
                               required>
                    </div>
                </div>

                {{-- STATUS INFO --}}
                <div class="alert alert-info mt-2">
                    Status saat ini:
                    <span class="fw-bold {{ $diskon->aktif ? 'text-success' : 'text-secondary' }}">
                        {{ $diskon->aktif ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                    (otomatis diperbarui saat disimpan)
                </div>

            </div>

            <div class="card-footer bg-white text-end">
                <a href="{{ route('admin.diskon.index') }}"
                   class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
