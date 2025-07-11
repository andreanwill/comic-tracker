@php
    use App\Models\Comic;
    use App\Models\Genre;
    use App\Models\User;
    $totalComics = Comic::count();
    $totalGenres = Genre::count();
    $totalUsers = User::where('role', 'user')->count();
@endphp

@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-semibold text-primary">Selamat Datang, {{ auth()->user()->name }}</h2>
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card stat-card shadow-sm border-0 text-center p-4">
                <h5 class="text-secondary">Total Komik</h5>
                <div class="display-4 fw-bold text-primary">{{ $totalComics }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card shadow-sm border-0 text-center p-4">
                <h5 class="text-secondary">Total Genre</h5>
                <div class="display-4 fw-bold text-success">{{ $totalGenres }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card shadow-sm border-0 text-center p-4">
                <h5 class="text-secondary">Total User</h5>
                <div class="display-4 fw-bold text-info">{{ $totalUsers }}</div>
            </div>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title">Manajemen Komik</h5>
                    <p class="card-text">Tambah, edit, atau hapus data komik yang tersedia di sistem.</p>
                    <a href="{{ route('admin.comics.index') }}" class="btn btn-primary">Kelola Komik</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title">Manajemen Genre</h5>
                    <p class="card-text">Kelola daftar genre komik yang tersedia.</p>
                    <a href="/admin/genres" class="btn btn-success">Kelola Genre</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
