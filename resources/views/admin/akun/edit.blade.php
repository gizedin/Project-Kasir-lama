@extends('layouts.app')

@section('content')
<div class="container col-md-6">
    <h4>Edit Akun Admin</h4>

    <form action="{{ route('admin.akun.update', $akun->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Username</label>
            <input type="text"
                   name="username"
                   class="form-control"
                   value="{{ $akun->username }}"
                   required>
        </div>

        <div class="mb-3">
            <label>Password (opsional)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.akun.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
