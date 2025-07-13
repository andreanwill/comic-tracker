@extends('layouts.template')
@section('content')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Comic Tracker</title>

        <!-- Bootstrap 5 CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    </head>
    <body class="bg-light">
        <!-- Jumbotron -->
        <div class="container mb-5">
            <div class="p-5 mb-4 bg-primary bg-opacity-10 rounded-3">
                <div class="container-fluid py-3">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-lg-7 text-center text-lg-start mb-4 mb-lg-0">
                            <h1 class="display-5 fw-bold">Comic Tracker</h1>
                            <p class="col-lg-10 mx-auto fs-5 text-secondary">
                                Comic Tracker adalah aplikasi untuk melacak daftar bacaan komik Anda. User dapat menambahkan komik ke daftar baca, sedangkan admin dapat menambah dan mengelola data komik serta genre melalui dashboard admin.
                            </p>
                        </div>
                        <div class="col-lg-5 text-center">
                            @if(isset($jumbotronImages) && count($jumbotronImages) > 0)
                            <div id="jumbotronCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner rounded shadow-sm">
                                    @foreach($jumbotronImages as $img)
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <img src="{{ asset('storage/'.$img->image_path) }}" class="d-block w-100" alt="Jumbotron" style="max-height:260px;object-fit:contain;">
                                        </div>
                                    @endforeach
                                </div>
                                @if(count($jumbotronImages) > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#jumbotronCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#jumbotronCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                                @endif
                            </div>
                            @else
                            <div class="d-flex align-items-center justify-content-center bg-light" style="height: 260px;">
                                <span class="text-secondary display-3">📚</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- List Komik -->
        <div class="container pb-5">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h2 class="fw-semibold text-primary mb-0">Daftar Komik</h2>
                <a href="/comics" class="btn btn-primary px-4">Lihat Semua</a>
            </div>
            <div class="row g-4">
                @forelse($comics as $comic)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card h-100 shadow-sm border-0">
                            @if($comic->cover_image)
                                @if(Str::startsWith($comic->cover_image, ['http://', 'https://']))
                                    <img src="{{ $comic->cover_image }}" class="card-img-top" alt="{{ $comic->title }}" style="height: 260px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('storage/' . $comic->cover_image) }}" class="card-img-top" alt="{{ $comic->title }}" style="height: 260px; object-fit: cover;">
                                @endif
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light" style="height: 260px;">
                                    <span class="text-secondary display-3">📚</span>
                                </div>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-truncate" title="{{ $comic->title }}">{{ $comic->title }}</h5>
                                <div class="mb-2">
                                    @foreach($comic->genres as $genre)
                                        <span class="badge badge-primary me-1">{{ $genre->name }}</span>
                                    @endforeach
                                </div>
                                <p class="card-text text-muted small mb-2" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">{{ $comic->description }}</p>
                                <a href="{{ route('comics.show', $comic->id) }}" class="btn btn-outline-primary btn-sm mt-auto">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">Belum ada komik.</div>
                @endforelse
            </div>
        </div>
    </body>
</html>

@endsection