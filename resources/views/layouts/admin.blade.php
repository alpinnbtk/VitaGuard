<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — VitaGuard Admin</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-bg: #0f172a;
            --sidebar-hover: #1e293b;
            --sidebar-active: #0ea5e9;
            --accent: #0ea5e9;
            --accent-dark: #0284c7;
        }

        * { font-family: 'Inter', sans-serif; }

        body {
            background: #f1f5f9;
            min-height: 100vh;
        }

        /* ── Sidebar ── */
        .sidebar {
            position: fixed;
            top: 0; left: 0; bottom: 0;
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            color: #cbd5e1;
            z-index: 1000;
            overflow-y: auto;
            transition: transform 0.3s;
        }

        .sidebar-brand {
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar-brand .logo-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, #0ea5e9, #06b6d4);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: white;
            font-weight: 700;
        }

        .sidebar-brand h5 {
            margin: 0;
            color: #f8fafc;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .sidebar-brand small {
            color: #64748b;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .sidebar-menu .menu-label {
            padding: 0.5rem 1.5rem;
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #475569;
            font-weight: 600;
        }

        .sidebar-menu .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.7rem 1.5rem;
            color: #94a3b8;
            font-size: 0.875rem;
            font-weight: 400;
            border-radius: 0;
            transition: all 0.15s;
            border-left: 3px solid transparent;
        }

        .sidebar-menu .nav-link:hover {
            background: var(--sidebar-hover);
            color: #e2e8f0;
        }

        .sidebar-menu .nav-link.active {
            background: rgba(14, 165, 233, 0.1);
            color: var(--sidebar-active);
            border-left-color: var(--sidebar-active);
            font-weight: 500;
        }

        .sidebar-menu .nav-link i {
            font-size: 1.1rem;
            width: 1.5rem;
            text-align: center;
        }

        /* ── Main content ── */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .topbar {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.75rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .topbar h1 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #0f172a;
            margin: 0;
        }

        .content-area {
            padding: 2rem;
        }

        /* ── Cards + Tables ── */
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid #e2e8f0;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        }

        .stat-card .stat-icon {
            width: 48px; height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .card-custom {
            background: white;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .card-custom .card-header {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-custom .card-header h5 {
            margin: 0;
            font-weight: 600;
            font-size: 1rem;
            color: #0f172a;
        }

        .table th {
            background: #f8fafc;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            font-weight: 600;
            border-bottom-width: 1px;
        }

        .table td {
            vertical-align: middle;
            font-size: 0.875rem;
            color: #334155;
        }

        .badge-status {
            font-size: 0.75rem;
            font-weight: 500;
            padding: 0.35em 0.75em;
            border-radius: 6px;
        }

        .btn-primary {
            background: var(--accent);
            border-color: var(--accent);
        }

        .btn-primary:hover {
            background: var(--accent-dark);
            border-color: var(--accent-dark);
        }

        /* ── Alert ── */
        .alert {
            border-radius: 10px;
            border: none;
            font-size: 0.875rem;
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="logo-icon">
                <i class="bi bi-heart-pulse"></i>
            </div>
            <div>
                <h5>VitaGuard</h5>
                <small>Admin Panel</small>
            </div>
        </div>

        <nav class="sidebar-menu">
            <div class="menu-label">Main</div>
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>

            <div class="menu-label mt-3">Master Data</div>
            <a href="{{ route('admin.users.index') }}"
               class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i> Users
            </a>
            <a href="{{ route('admin.doctors.index') }}"
               class="nav-link {{ request()->routeIs('admin.doctors.*') ? 'active' : '' }}">
                <i class="bi bi-hospital"></i> Dokter
            </a>
            <a href="{{ route('admin.categories.index') }}"
               class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="bi bi-tag-fill"></i> Kategori
            </a>
            <a href="{{ route('admin.articles.index') }}"
               class="nav-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                <i class="bi bi-newspaper"></i> Artikel
            </a>

            <div class="menu-label mt-3">Transaksi</div>
            <a href="{{ route('admin.transactions.index') }}"
               class="nav-link {{ request()->routeIs('admin.transactions.*') ? 'active' : '' }}">
                <i class="bi bi-receipt-cutoff"></i> Konsultasi
            </a>
        </nav>
    </aside>

    <!-- Main content -->
    <div class="main-content">
        <header class="topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-sm btn-light d-md-none" onclick="document.getElementById('sidebar').classList.toggle('show')">
                    <i class="bi bi-list"></i>
                </button>
                <h1>@yield('title', 'Dashboard')</h1>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="text-muted small">Admin</span>
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width:35px;height:35px;">
                    <i class="bi bi-person-fill"></i>
                </div>
            </div>
        </header>

        <div class="content-area">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
