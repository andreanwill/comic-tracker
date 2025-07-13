@extends('layouts.template')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $comic->title }} - Detail Komik | Comic Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-brand { color: #0d6efd !important; }
        .footer { background: #f1f3f6; color: #6c757d; }
        .cover-img { object-fit: cover; width: 100%; min-height: 320px; max-height: 420px; border-radius: 1rem; }
        .genre-badge { font-size: 0.95em; }
    </style>
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    <div class="container pb-5 flex-grow-1">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="card shadow-sm border-0 mb-4 p-3 p-md-4">
                    <div class="row g-4 align-items-center">
                        <div class="col-md-5 text-center">
                            @if($comic->cover_image)
                                @if(Str::startsWith($comic->cover_image, ['http://', 'https://']))
                                    <img src="{{ $comic->cover_image }}" class="card-img-top" alt="{{ $comic->title }}" style="object-fit: cover;">
                                @else
                                    <img src="{{ asset('storage/' . $comic->cover_image) }}" class="card-img-top" alt="{{ $comic->title }}" style="height: 260px; object-fit: cover;">
                                @endif
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light cover-img mb-3 mb-md-0" style="height: 320px;">
                                    <span class="text-secondary display-3">📚</span>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-7">
                            <h2 class="fw-bold mb-2">{{ $comic->title }}</h2>
                            <div class="mb-3">
                                @forelse($comic->genres as $genre)
                                    <span class="badge bg-primary genre-badge me-1 mb-1">{{ $genre->name }}</span>
                                @empty
                                    <span class="text-muted small">Tidak ada genre</span>
                                @endforelse
                            </div>
                            <h6 class="text-secondary mb-2">Deskripsi</h6>
                            <p class="card-text text-muted mb-3" style="white-space: pre-line;">{{ $comic->description ?? '-' }}</p>
                            <a href="{{ route('comics.show', $comic->id) }}" class="btn btn-outline-primary btn-sm mt-auto">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

@endsection