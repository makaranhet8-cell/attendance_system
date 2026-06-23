<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Attendance System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background-color: #f8fafc; /* ប្តូរមកពណ៌ប្រផេះស្រាលបែប Clean */
            color: #1e293b;
        }

        /* តុបតែង Sidebar ឱ្យមានរាង Gradient ងងឹតបែបអាជីព */
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
            color: #fff;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.02);
            transition: all 0.3s ease;
        }
        .sidebar .brand {
            font-size: 1.15rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            color: #f8fafc;
        }
        .sidebar a {
            color: #94a3b8;
            font-weight: 500;
            font-size: 0.95rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 18px;
            border-radius: 10px;
            margin: 4px 12px;
            transition: all 0.2s ease;
        }
        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: #fff;
        }
        /* ស្ទីលនៅពេល Menu ដំណើរការ (Active) គឺវាដុះពណ៌ខៀវ និងមានស្រមោល Glow */
        .sidebar a.active {
            background: #2563eb;
            color: #fff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
            font-weight: 600;
        }

        /* Navbar ផ្នែកខាងលើ ធ្វើឱ្យមានលក្ខណៈថ្លាៗបន្តិច (Blur Effect) */
        .navbar-top {
            background-color: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(8px);
            border-bottom: 1px solid #e2e8f0;
            padding: 15px 24px;
        }

        .content-wrapper {
            padding: 32px;
        }

        /* កែប្រែប្រអប់ Alert ទិន្នន័យជោគជ័យ ឬកំហុសឱ្យមានរាងមូលស្អាត */
        .custom-alert {
            border: none;
            border-radius: 12px;
            padding: 16px 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }

        /* ស្ទីលរួមសម្រាប់តារាង និងកាតទូទៅក្នុងប្រព័ន្ធ */
        .card {
            border: none;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.02);
            border-radius: 14px;
        }
        table th {
            font-weight: 600;
            font-size: .85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
    </style>
    @stack('styles')
</head>
<body>
<div class="d-flex">
    <nav class="sidebar" style="width: 250px; flex-shrink: 0;">
        <div class="brand d-flex align-items-center gap-2">
            <i class="bi bi-mortarboard-fill text-primary fs-4"></i>
            <h4>Students Attendance</h4>
        </div>
        <div class="mt-3">
            @include('partials.sidebar')
        </div>
    </nav>

    <div class="flex-grow-1 min-vh-100 d-flex flex-column">
        @include('partials.navbar')

        <div class="content-wrapper flex-grow-1">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show custom-alert d-flex align-items-center gap-2 mb-4" role="alert">
                    <i class="bi bi-check-circle-fill fs-5"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" style="top: 14px;"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show custom-alert mb-4" role="alert">
                    <div class="d-flex align-items-center gap-2 mb-2 fw-semibold">
                        <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                        <span>Please fix the following errors:</span>
                    </div>
                    <ul class="mb-0 ps-4 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" style="top: 14px;"></button>
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
