@extends('layouts.admin')
@section('title', 'Kelola Komik')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-semibold text-primary mb-0">Daftar Komik</h2>
        <a href="{{ route('admin.comics.create') }}" class="btn btn-success"><i class="bi bi-plus-lg"></i> Tambah Komik</a>
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
                    <th scope="col">Cover</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Genre</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($comics as $index => $comic)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td style="width: 80px;">
                        @if($comic->cover_image)
                            @if(Str::startsWith($comic->cover_image, ['http://', 'https://']))
                                <img src="{{ $comic->cover_image }}" class="card-img-top" alt="{{ $comic->title }}" style="height: 260px; object-fit: cover;">
                            @else
                                <img src="{{ asset('storage/' . $comic->cover_image) }}" class="card-img-top" alt="{{ $comic->title }}" style="height: 260px; object-fit: cover;">
                            @endif
                        @else
                            <span class="text-secondary fs-2">📚</span>
                        @endif
                    </td>
                    <td class="fw-semibold">{{ $comic->title }}</td>
                    <td style="max-width: 250px;">
                        <span class="text-muted small" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $comic->description }}</span>
                    </td>
                    <td>
                        @foreach ($comic->genres as $genre)
                            <span class="badge bg-primary mb-1">{{ $genre->name }}</span>
                        @endforeach
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.comics.edit', $comic->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Edit</a>
                            <form method="POST" action="{{ route('admin.comics.destroy', $comic->id) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')"><i class="bi bi-trash"></i> Hapus</button>
                            </form>
                        </div>
                    </td>


                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada komik.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection
