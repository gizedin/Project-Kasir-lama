@extends('layouts.app')

@section('content')
<div class="container col-md-6">
    <h4>Tambah Akun Admin</h4>

    <form action="{{ route('admin.akun.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.akun.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
