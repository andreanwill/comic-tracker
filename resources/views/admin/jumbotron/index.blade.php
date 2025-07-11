@extends('layouts.admin')
@section('title', 'Kelola Gambar Jumbotron')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-semibold text-primary mb-0">Kelola Gambar Jumbotron (Carousel)</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali Dashboard</a>
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
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('admin.jumbotron.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="images" class="form-label fw-semibold">Upload Gambar Jumbotron (max 5 gambar, JPG/PNG/GIF, max 2MB per gambar)</label>
                    <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple {{ count($images) >= 5 ? 'disabled' : '' }}>
                    @if(count($images) >= 5)
                        <div class="form-text text-danger">Maksimal 5 gambar sudah tercapai. Hapus gambar untuk menambah baru.</div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary" {{ count($images) >= 5 ? 'disabled' : '' }}><i class="bi bi-upload"></i> Upload</button>
            </form>
        </div>
    </div>
    <div class="row g-4">
        @foreach($images as $img)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100 shadow-sm border-0">
                <img src="{{ asset('storage/'.$img->image_path) }}" class="card-img-top" alt="Jumbotron" style="height: 180px; object-fit: cover;">
                <div class="card-body d-flex flex-column align-items-center">
                    <form action="{{ route('admin.jumbotron.destroy', $img->id) }}" method="POST" onsubmit="return confirm('Yakin hapus gambar ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @if(count($images) > 1)
    <div class="mt-4">
        <h5 class="fw-semibold">Urutkan Gambar</h5>
        <form id="orderForm" action="{{ route('admin.jumbotron.updateOrder') }}" method="POST">
            @csrf
            <div class="d-flex flex-wrap gap-3">
                @foreach($images as $img)
                    <div class="d-flex flex-column align-items-center">
                        <img src="{{ asset('storage/'.$img->image_path) }}" style="height: 80px; width: 120px; object-fit: cover;" class="rounded mb-2">
                        <input type="number" name="orders[{{ $img->id }}]" value="{{ $img->order }}" min="1" max="5" class="form-control form-control-sm text-center" style="width: 60px;">
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-success mt-3"><i class="bi bi-sort-numeric-down"></i> Simpan Urutan</button>
        </form>
    </div>
    @endif
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection 