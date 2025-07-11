@extends('layouts.admin')
@section('title', 'Tambah Genre')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-semibold text-primary">Tambah Genre Baru</h2>
        <a href="{{ route('admin.genres.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>
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
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form action="{{ route('admin.genres.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Nama Genre <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">Deskripsi Genre</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Simpan Genre</button>
                    <a href="{{ route('admin.genres.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 