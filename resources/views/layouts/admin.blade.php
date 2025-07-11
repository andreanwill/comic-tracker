<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Comic Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .stat-card { border-radius: 1rem; }
        .admin-avatar { width: 48px; height: 48px; border-radius: 50%; background: #0d6efd; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/admin">Admin Dashboard</a>
            <div class="navbar-nav me-auto">
                <a class="nav-link" href="/"><i class="bi bi-house"></i> Halaman Utama</a>
                <a class="nav-link" href="{{ route('admin.comics.index') }}"><i class="bi bi-book"></i> Kelola Komik</a>
                <a class="nav-link" href="/admin/genres"><i class="bi bi-tags"></i> Kelola Genre</a>
            </div>
            <div class="d-flex align-items-center">
                <div class="admin-avatar me-2">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</div>
                <span class="text-white me-3">{{ auth()->user()->name }} (Admin)</span>
                <form method="POST" action="/logout" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>
    
    @yield('content')
    
    <footer class="footer py-4 mt-5 bg-white border-top">
        <div class="container text-center">
            <small>&copy; {{ date('Y') }} Comic Tracker Admin. All rights reserved.</small>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 