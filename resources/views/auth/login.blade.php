@extends('layouts.template')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Comic Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-brand { color: #0d6efd !important; }
        .footer { background: #f1f3f6; color: #6c757d; }
    </style>
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    <div class="container d-flex align-items-center justify-content-center flex-grow-1">
        <div class="col-12 col-sm-8 col-md-5 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="mb-4 text-center text-primary fw-bold">Login</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger py-2 mb-3">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    <form method="POST" action="/login">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                    <div class="mt-3 text-center">
                        <span class="text-muted">Belum punya akun?</span>
                        <a href="{{ route('register') }}" class="text-primary">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

@endsection