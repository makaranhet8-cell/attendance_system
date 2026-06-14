<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Attendance System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f6f9; }
        .sidebar {
            min-height: 100vh;
            background-color: #1e293b;
            color: #fff;
        }
        .sidebar a {
            color: #cbd5e1;
            text-decoration: none;
            display: block;
            padding: 10px 18px;
            border-radius: 6px;
            margin: 2px 8px;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #334155;
            color: #fff;
        }
        .sidebar .brand {
            font-size: 1.2rem;
            font-weight: 600;
            padding: 18px;
            border-bottom: 1px solid #334155;
        }
        .navbar-top {
            background-color: #fff;
            border-bottom: 1px solid #e2e8f0;
        }
        .content-wrapper { padding: 24px; }
        .card { border: none; box-shadow: 0 1px 3px rgba(0,0,0,.08); border-radius: 10px; }
        table th { font-weight: 600; font-size: .9rem; }
    </style>
    @stack('styles')
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <nav class="sidebar" style="width: 240px;">
        <div class="brand">
            <i class="bi bi-mortarboard-fill"></i> Attendance System
        </div>
        @include('partials.sidebar')
    </nav>

    <!-- Main content -->
    <div class="flex-grow-1">
        @include('partials.navbar')

        <div class="content-wrapper">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
