<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar — VitaGuard</title>

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
            padding: 2rem 1rem;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 480px;
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

        .password-strength {
            height: 4px;
            border-radius: 2px;
            background: #e2e8f0;
            margin-top: 0.5rem;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            border-radius: 2px;
            width: 0%;
            transition: width 0.3s, background 0.3s;
        }

        .strength-text {
            font-size: 0.72rem;
            margin-top: 0.3rem;
            color: #94a3b8;
        }

        .section-divider {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 1.25rem 0 1rem;
        }

        .section-divider hr {
            flex: 1;
            margin: 0;
            border-color: #f1f5f9;
        }

        .section-divider span {
            font-size: 0.7rem;
            font-weight: 600;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1px;
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
            <h5>Buat akun baru</h5>
            <p class="subtitle">Daftarkan diri Anda untuk mengakses layanan kesehatan</p>

            {{-- Alert Error --}}
            @if($errors->any())
                <div class="alert alert-danger mb-3">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf

                {{-- Informasi Akun --}}
                <div class="section-divider">
                    <span>Informasi Akun</span>
                    <hr>
                </div>

                {{-- Name --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input
                        type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap"
                        autofocus
                        required
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Username --}}
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input
                        type="text"
                        class="form-control @error('username') is-invalid @enderror"
                        id="username"
                        name="username"
                        value="{{ old('username') }}"
                        placeholder="Masukkan username"
                        required
                    >
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

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
                        required
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Phone --}}
                <div class="mb-3">
                    <label for="phone_number" class="form-label">
                        Nomor Telepon
                        <span class="text-muted fw-normal">(opsional)</span>
                    </label>
                    <input
                        type="tel"
                        class="form-control @error('phone_number') is-invalid @enderror"
                        id="phone_number"
                        name="phone_number"
                        value="{{ old('phone_number') }}"
                        placeholder="08xxxxxxxxxx"
                    >
                    @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="section-divider">
                    <span>Keamanan</span>
                    <hr>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            id="password"
                            name="password"
                            placeholder="Minimal 8 karakter"
                            oninput="checkStrength(this.value)"
                            required
                        >
                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password', 'iconPassword')">
                            <i class="bi bi-eye" id="iconPassword"></i>
                        </button>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="password-strength">
                        <div class="password-strength-bar" id="strengthBar"></div>
                    </div>
                    <div class="strength-text" id="strengthText"></div>
                </div>

                {{-- Confirm Password --}}
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <div class="input-group">
                        <input
                            type="password"
                            class="form-control"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Ulangi password"
                            required
                        >
                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_confirmation', 'iconConfirm')">
                            <i class="bi bi-eye" id="iconConfirm"></i>
                        </button>
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-person-plus-fill me-2"></i>Buat Akun
                </button>
            </form>
        </div>

        {{-- Footer --}}
        <div class="auth-footer">
            Sudah punya akun?
            <a href="{{ route('login') }}">Masuk di sini</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        }

        function checkStrength(value) {
            const bar = document.getElementById('strengthBar');
            const text = document.getElementById('strengthText');

            let score = 0;
            if (value.length >= 8) score++;
            if (/[A-Z]/.test(value)) score++;
            if (/[0-9]/.test(value)) score++;
            if (/[^A-Za-z0-9]/.test(value)) score++;

            const levels = [
                { width: '0%',   color: '#e2e8f0', label: '' },
                { width: '25%',  color: '#ef4444', label: 'Lemah' },
                { width: '50%',  color: '#f97316', label: 'Cukup' },
                { width: '75%',  color: '#eab308', label: 'Kuat' },
                { width: '100%', color: '#22c55e', label: 'Sangat Kuat' },
            ];

            const level = value.length === 0 ? levels[0] : levels[score];
            bar.style.width = level.width;
            bar.style.background = level.color;
            text.style.color = level.color;
            text.textContent = level.label;
        }
    </script>
</body>
</html>
