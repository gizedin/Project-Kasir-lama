@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h4>Manajemen Akun</h4>
        <a href="{{ route('admin.akun.create') }}" class="btn btn-primary">
            + Admin
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped" id="akunTable">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Role</th>
                <th width="180">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($akuns as $akun)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $akun->username }}</td>
                <td>
                    <span class="badge bg-{{ $akun->role === 'admin' ? 'danger' : 'secondary' }}">
                        {{ $akun->role }}
                    </span>
                </td>
                <td>
                    @if($akun->role === 'admin')
                        <a href="{{ route('admin.akun.edit', $akun->id) }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('admin.akun.destroy', $akun->id) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus akun admin?')">
                                Hapus
                            </button>
                        </form>
                    @else
                        <span class="text-muted fst-italic">Readonly</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $('#akunTable').DataTable({
        language: {
            search: "Cari Akun:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ akun",
            paginate: {
                next: "›",
                previous: "‹"
            }
        }
    });
});
</script>
@endpush
