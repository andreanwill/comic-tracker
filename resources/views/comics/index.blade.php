<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Komik - Comic Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-brand { color: #0d6efd !important; }
        .footer { background: #f1f3f6; color: #6c757d; }
    </style>
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">Comic Tracker</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="/comics">List Komik</a>
                    </li>
                    @auth
                    <li class="nav-item d-flex align-items-center">
                        <span class="nav-link disabled">{{ auth()->user()->name }}</span>
                    </li>
                    @if(auth()->user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="/admin">Dashboard Admin</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <form method="POST" action="/logout" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link" style="display:inline;cursor:pointer;">Logout</button>
                        </form>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <div class="container pb-5 flex-grow-1">
        <h2 class="mb-4 text-center fw-semibold text-primary">List Komik</h2>
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
                                    <span class="badge bg-primary me-1">{{ $genre->name }}</span>
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
    <!-- Footer -->
    <footer class="footer py-4 mt-auto">
        <div class="container text-center">
            <small>&copy; {{ date('Y') }} Comic Tracker. All rights reserved.</small>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 