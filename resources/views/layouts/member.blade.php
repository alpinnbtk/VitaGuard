<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-fav.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Beranda — VitaGuard')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --accent:      #2bb3a7;
            --accent-dark: #1c5578;
            --dark:        #123852;
            --surface:     #f3faf9;
        }

        * { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Sora', sans-serif; letter-spacing: -0.01em; }

        body {
            background: var(--surface);
            min-height: 100vh;
        }

        /* ── NAVBAR ───────────────────────────────── */
        .navbar {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.75rem 0;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-weight: 700;
            color: var(--dark);
            font-size: 1.1rem;
            text-decoration: none;
        }

        .navbar .nav-link {
            font-size: 0.875rem;
            color: #64748b;
            font-weight: 400;
            padding: 0.4rem 0.75rem;
            border-radius: 6px;
            transition: all 0.15s;
        }

        .navbar .nav-link:hover,
        .navbar .nav-link.active {
            color: var(--accent);
            background: rgba(14, 165, 233, 0.07);
        }

        .navbar .nav-link i {
            margin-right: 0.3rem;
        }

        .user-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.825rem;
            color: #475569;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #0ea5e9, #06b6d4);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.8rem;
        }
    </style>
    @stack('styles')
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('member.home') }}">
                <img src="{{ asset('images/logo-fav.png') }}" alt="Logo VitaGuard" style="height: 32px; width: auto;">
                VitaGuard
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <i class="bi bi-list fs-5 text-dark"></i>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav mx-auto gap-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('member.home') ? 'active' : '' }}" href="{{ route('member.home') }}">
                            <i class="bi bi-house"></i>Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('member.articles.*') ? 'active' : '' }}" href="{{ route('member.articles.index') }}">
                            <i class="bi bi-newspaper"></i>Artikel
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('member.doctors.*') ? 'active' : '' }}" href="{{ route('member.doctors.index') }}">
                            <i class="bi bi-hospital"></i>Dokter
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('member.booking.*') ? 'active' : '' }}" href="{{ route('member.booking.index') }}">
                            <i class="bi bi-calendar-check"></i>Booking
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('member.consultations.*') ? 'active' : '' }}" href="{{ route('member.consultations.index') }}">
                            <i class="bi bi-chat-dots"></i>Konsultasi
                        </a>
                    </li>
                </ul>

                {{-- User Section --}}
                <div class="d-flex align-items-center gap-3">
                    <div class="user-badge">
                        <div class="user-avatar">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <span>{{ Auth::user()->name }}</span>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger" style="font-size:0.775rem; border-radius:6px;">
                            <i class="bi bi-box-arrow-right me-1"></i>Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
