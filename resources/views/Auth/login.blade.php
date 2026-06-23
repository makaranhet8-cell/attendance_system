<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Attendance System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            /* ផ្ទៃក្រោយលេងពណ៌ Gradient ងងឹតស្រាល បង្កើតអារម្មណ៍បែប Premium */
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
        }
        .login-card {
            border: none;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25) !important;
            padding: 40px 30px !important;
        }
        .brand-icon {
            width: 60px;
            height: 60px;
            background: #2563eb;
            color: white;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px auto;
            box-shadow: 0 8px 16px rgba(37, 99, 235, 0.2);
        }
        .form-label {
            font-weight: 500;
            color: #475569;
            font-size: 0.9rem;
        }
        /* កែប្រែប្រអប់បញ្ចូលទិន្នន័យ (Input Group) */
        .input-group-text {
            background-color: #f8fafc;
            border-right: none;
            color: #94a3b8;
            border-radius: 12px 0 0 12px;
            padding-left: 16px;
            padding-right: 16px;
        }
        .form-control {
            border-left: none;
            border-radius: 0 12px 12px 0;
            padding: 12px 14px;
            background-color: #f8fafc;
            color: #1e293b;
            font-weight: 500;
        }
        .form-control:focus {
            background-color: #fff;
            border-color: #3b82f6;
            box-shadow: none;
        }
        .form-control:focus + .input-group-text,
        .input-group:focus-within .input-group-text {
            border-color: #3b82f6;
            background-color: #fff;
            color: #2563eb;
        }
        .btn-login {
            background: #2563eb;
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.5px;
            transition: all 0.2s ease;
        }
        .btn-login:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.3);
        }
        .custom-alert {
            border: none;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card login-card style-form" style="width: 100%; max-width: 420px;">

        <div class="brand-icon">
            <i class="bi bi-mortarboard-fill fs-3"></i>
        </div>

        <h4 class="text-center fw-bold mb-1 text-dark">ចូលប្រើប្រព័ន្ធ</h4>
        <p class="text-center text-muted small mb-4">Attendance Management System</p>

        @if($errors->any())
            <div class="alert alert-danger custom-alert d-flex align-items-center gap-2 mb-3" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <div>{{ $errors->first() }}</div>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">អត្តសញ្ញាណប័ណ្ណ (ID)</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                    <input type="number" name="id" class="form-control @error('id') is-invalid @enderror" value="{{ old('id') }}" placeholder="បញ្ចូល ID របស់អ្នក" required autocomplete="off">
                </div>
                @error('id') <div class="text-danger small mt-1"><i class="bi bi-info-circle"></i> {{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">លេខកូដសម្ងាត់ (Password)</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-login w-100 shadow-sm">
                Login <i class="bi bi-arrow-right-short ms-1"></i>
            </button>
        </form>
    </div>
</div>

</body>
</html>
