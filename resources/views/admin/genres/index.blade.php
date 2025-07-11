@extends('layouts.admin')
@section('title', 'Kelola Genre')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-semibold text-primary mb-0">Daftar Genre</h2>
        <a href="{{ route('admin.genres.create') }}" class="btn btn-success"><i class="bi bi-plus-lg"></i> Tambah Genre</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-hover align-middle bg-white shadow-sm rounded">
            <thead class="table-primary">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Genre</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($genres as $index => $genre)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="fw-semibold">{{ $genre->name }}</td>
                    <td class="text-muted small">{{ $genre->description ?? '-' }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.genres.edit', $genre->id) }}" class="btn btn-warning btn-sm me-1"><i class="bi bi-pencil"></i> Edit</a>
                        <form method="POST" action="{{ route('admin.genres.destroy', $genre->id) }}" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus genre ini?')"><i class="bi bi-trash"></i> Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Belum ada genre.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection 