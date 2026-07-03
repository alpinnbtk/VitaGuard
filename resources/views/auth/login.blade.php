<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login — VitaGuard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --accent: #0ea5e9;
            --accent-dark: #0284c7;
            --dark: #0f172a;
        }

        * { font-family: 'Inter', sans-serif; }

        body {
            background: #f1f5f9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 440px;
            padding: 1.5rem;
        }

        .auth-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .auth-brand .logo-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #0ea5e9, #06b6d4);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            color: white;
        }

        .auth-brand h4 {
            margin: 0;
            color: var(--dark);
            font-weight: 700;
            font-size: 1.4rem;
            letter-spacing: -0.5px;
        }

        .auth-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            padding: 2rem;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.05);
        }

        .auth-card h5 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.25rem;
        }

        .auth-card p.subtitle {
            font-size: 0.85rem;
            color: #64748b;
            margin-bottom: 1.75rem;
        }

        .form-label {
            font-size: 0.8rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.4rem;
        }

        .form-control {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 0.875rem;
            padding: 0.6rem 0.875rem;
            color: #0f172a;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.12);
        }

        .input-group .form-control {
            border-right: none;
            border-radius: 8px 0 0 8px;
        }

        .input-group .btn-outline-secondary {
            border: 1px solid #e2e8f0;
            border-left: none;
            border-radius: 0 8px 8px 0;
            background: #f8fafc;
            color: #64748b;
            font-size: 0.9rem;
        }

        .input-group .btn-outline-secondary:hover {
            background: #f1f5f9;
            color: #0f172a;
        }

        .input-group .form-control:focus + .btn-outline-secondary {
            border-color: var(--accent);
        }

        .btn-primary {
            background: var(--accent);
            border: none;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 0.65rem;
            transition: background 0.15s, transform 0.1s;
        }

        .btn-primary:hover {
            background: var(--accent-dark);
            transform: translateY(-1px);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 1.5rem 0;
        }

        .divider hr {
            flex: 1;
            margin: 0;
            border-color: #e2e8f0;
        }

        .divider span {
            font-size: 0.75rem;
            color: #94a3b8;
        }

        .auth-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.825rem;
            color: #64748b;
        }

        .auth-footer a {
            color: var(--accent);
            font-weight: 500;
            text-decoration: none;
        }

        .auth-footer a:hover {
            color: var(--accent-dark);
            text-decoration: underline;
        }

        .alert {
            border-radius: 10px;
            border: none;
            font-size: 0.825rem;
            padding: 0.75rem 1rem;
        }

        .form-check-input:checked {
            background-color: var(--accent);
            border-color: var(--accent);
        }

        .form-check-label {
            font-size: 0.825rem;
            color: #475569;
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">

        {{-- Brand --}}
        <div class="auth-brand">
            <div class="logo-icon">
                <i class="bi bi-heart-pulse"></i>
            </div>
            <h4>VitaGuard</h4>
        </div>

        {{-- Card --}}
        <div class="auth-card">
            <h5>Selamat datang kembali</h5>
            <p class="subtitle">Masuk ke akun Anda untuk melanjutkan</p>

            {{-- Alert Error --}}
            @if($errors->any())
                <div class="alert alert-danger mb-3">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- Alert Session --}}
            @if(session('status'))
                <div class="alert alert-success mb-3">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="contoh@email.com"
                        autofocus
                        required
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            required
                        >
                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                            <i class="bi bi-eye" id="toggleIcon"></i>
                        </button>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Remember Me --}}
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                </button>
            </form>
        </div>

        {{-- Footer --}}
        <div class="auth-footer">
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar sekarang</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        }
    </script>
</body>
</html>
