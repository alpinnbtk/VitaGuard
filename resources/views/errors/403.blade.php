<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 — Akses Ditolak | VitaGuard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --dark:   #0f172a;
            --accent: #0ea5e9;
            --danger: #ef4444;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            color: #e2e8f0;
        }

        .error-container {
            text-align: center;
            max-width: 540px;
            width: 100%;
        }

        .error-icon-wrap {
            position: relative;
            display: inline-block;
            margin-bottom: 2rem;
        }

        .error-circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(239, 68, 68, 0.12);
            border: 2px solid rgba(239, 68, 68, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            animation: pulse-ring 2s infinite;
        }

        .error-circle i {
            font-size: 3.5rem;
            color: var(--danger);
        }

        @keyframes pulse-ring {
            0%   { box-shadow: 0 0 0 0   rgba(239,68,68,0.3); }
            70%  { box-shadow: 0 0 0 20px rgba(239,68,68,0);   }
            100% { box-shadow: 0 0 0 0   rgba(239,68,68,0);   }
        }

        .error-code {
            font-family: 'Sora', sans-serif;
            font-size: 6rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--danger), #f97316);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            margin-bottom: 0.5rem;
            letter-spacing: -4px;
        }

        .error-title {
            font-family: 'Sora', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #f8fafc;
            margin-bottom: 1rem;
        }

        .error-desc {
            font-size: 0.9rem;
            color: #94a3b8;
            line-height: 1.7;
            margin-bottom: 2.5rem;
        }

        .error-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.75rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--accent), #06b6d4);
            color: white;
            box-shadow: 0 4px 15px rgba(14,165,233,0.3);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(14,165,233,0.4);
            color: white;
        }

        .btn-ghost {
            background: rgba(255,255,255,0.07);
            color: #94a3b8;
            border: 1px solid rgba(255,255,255,0.1);
        }

        .btn-ghost:hover {
            background: rgba(255,255,255,0.12);
            color: #e2e8f0;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            justify-content: center;
            margin-bottom: 2.5rem;
            text-decoration: none;
        }

        .brand-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--accent), #06b6d4);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
        }

        .brand-text {
            font-family: 'Sora', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: #f8fafc;
        }

        .divider {
            width: 60px;
            height: 2px;
            background: linear-gradient(90deg, var(--danger), transparent);
            margin: 1.5rem auto;
        }
    </style>
</head>
<body>
    <div class="error-container">
        {{-- Brand --}}
        <a href="{{ url('/') }}" class="brand">
            <div class="brand-icon">
                <i class="bi bi-heart-pulse"></i>
            </div>
            <span class="brand-text">VitaGuard</span>
        </a>

        {{-- Icon --}}
        <div class="error-icon-wrap">
            <div class="error-circle">
                <i class="bi bi-shield-lock-fill"></i>
            </div>
        </div>

        {{-- Code & Message --}}
        <div class="error-code">403</div>
        <div class="divider"></div>
        <h1 class="error-title">Akses Ditolak</h1>
        <p class="error-desc">
            Anda tidak memiliki izin untuk mengakses halaman ini.<br>
            Pastikan Anda masuk dengan akun yang sesuai dengan peran yang diizinkan.
        </p>

        {{-- Action Buttons --}}
        <div class="error-actions">
            <a href="javascript:history.back()" class="btn-back btn-ghost">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="btn-back btn-primary-custom">
                        <i class="bi bi-house-fill"></i> Ke Dashboard
                    </a>
                @elseif(auth()->user()->role === 'doctor')
                    <a href="{{ route('doctor.home') }}" class="btn-back btn-primary-custom">
                        <i class="bi bi-house-fill"></i> Ke Beranda
                    </a>
                @else
                    <a href="{{ route('member.home') }}" class="btn-back btn-primary-custom">
                        <i class="bi bi-house-fill"></i> Ke Beranda
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn-back btn-primary-custom">
                    <i class="bi bi-box-arrow-in-right"></i> Masuk
                </a>
            @endauth
        </div>
    </div>
</body>
</html>
