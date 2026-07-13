@extends('layouts.member')

@section('title', 'Beranda — VitaGuard')

@push('styles')
    <style>
        .hero {
            background: linear-gradient(135deg, var(--dark) 0%, var(--accent-dark) 100%);
            color: white;
            padding: 3.5rem 0 3rem;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 280px;
            height: 280px;
            background: rgba(14, 165, 233, 0.12);
            border-radius: 50%;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -80px;
            right: 120px;
            width: 180px;
            height: 180px;
            background: rgba(6, 182, 212, 0.08);
            border-radius: 50%;
        }

        .hero h1 {
            font-size: 1.75rem;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 0.5rem;
        }

        .hero h1 span {
            color: var(--accent);
        }

        .hero p {
            font-size: 0.9rem;
            color: #94a3b8;
            margin-bottom: 0;
        }

        .hero-icon {
            font-size: 4rem;
            opacity: 0.15;
            position: absolute;
            right: 2rem;
            top: 50%;
            transform: translateY(-50%);
            color: white;
        }

        .section-title {
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #94a3b8;
            margin-bottom: 1rem;
        }

        .menu-card {
            background: white;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
            padding: 1.5rem;
            text-decoration: none;
            display: block;
            transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
            height: 100%;
        }

        .menu-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.07);
            border-color: var(--accent);
            text-decoration: none;
        }

        .menu-card .menu-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin-bottom: 1rem;
        }

        .menu-card h6 {
            font-size: 0.925rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.3rem;
        }

        .menu-card p {
            font-size: 0.775rem;
            color: #64748b;
            margin-bottom: 0;
            line-height: 1.5;
        }

        .menu-card .arrow {
            font-size: 0.8rem;
            color: var(--accent);
            margin-top: 1rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
            font-weight: 500;
        }

        .icon-blue   { background: rgba(14, 165, 233, 0.1);  color: #0ea5e9; }
        .icon-teal   { background: rgba(20, 184, 166, 0.1);  color: #14b8a6; }
        .icon-violet { background: rgba(139, 92, 246, 0.1);  color: #8b5cf6; }
        .icon-green  { background: rgba(34, 197, 94, 0.1);   color: #22c55e; }
        .icon-amber  { background: rgba(245, 158, 11, 0.1);  color: #f59e0b; }
    </style>
@endpush

@section('content')
    <section class="hero">
        <div class="container position-relative">
            <p style="font-size:0.8rem; color:#0ea5e9; font-weight:500; margin-bottom:0.5rem;">
                Selamat datang, {{ Auth::user()->name }} 👋
            </p>
            <h1>Layanan Kesehatan <span>Digital</span><br>Ada di Genggamanmu</h1>
            <p>Konsultasi dokter, booking jadwal, dan akses informasi kesehatan kapan saja.</p>
            <i class="bi bi-heart-pulse hero-icon"></i>
        </div>
    </section>

    <div class="container py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert"
                 style="border-radius:10px; border:none; font-size:0.875rem;">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <p class="section-title">Layanan</p>

        <div class="row g-3">
            <div class="col-6 col-lg-4">
                <a href="{{ route('member.articles.index') }}" class="menu-card">
                    <div class="menu-icon icon-blue">
                        <i class="bi bi-newspaper"></i>
                    </div>
                    <h6>Artikel Kesehatan</h6>
                    <p>Baca informasi dan tips kesehatan terpercaya dari para ahli.</p>
                    <div class="arrow">
                        Baca artikel <i class="bi bi-arrow-right"></i>
                    </div>
                </a>
            </div>

            <div class="col-6 col-lg-4">
                <a href="{{ route('member.doctors.index') }}" class="menu-card">
                    <div class="menu-icon icon-teal">
                        <i class="bi bi-hospital"></i>
                    </div>
                    <h6>Direktori Dokter</h6>
                    <p>Temukan dokter spesialis yang sesuai dengan kebutuhanmu.</p>
                    <div class="arrow">
                        Cari dokter <i class="bi bi-arrow-right"></i>
                    </div>
                </a>
            </div>

            <div class="col-6 col-lg-4">
                <a href="{{ route('member.booking.create') }}" class="menu-card">
                    <div class="menu-icon icon-violet">
                        <i class="bi bi-calendar-plus"></i>
                    </div>
                    <h6>Booking Konsultasi</h6>
                    <p>Pilih dokter dan jadwal yang tersedia untuk konsultasi online.</p>
                    <div class="arrow">
                        Buat booking <i class="bi bi-arrow-right"></i>
                    </div>
                </a>
            </div>

            <div class="col-6 col-lg-4">
                <a href="{{ route('member.consultations.index') }}" class="menu-card">
                    <div class="menu-icon icon-green">
                        <i class="bi bi-chat-dots"></i>
                    </div>
                    <h6>Konsultasi Online</h6>
                    <p>Mulai sesi konsultasi dengan dokter berdasarkan booking aktif.</p>
                    <div class="arrow">
                        Mulai konsultasi <i class="bi bi-arrow-right"></i>
                    </div>
                </a>
            </div>

            <div class="col-6 col-lg-4">
                <a href="{{ route('member.consultations.index') }}" class="menu-card">
                    <div class="menu-icon icon-amber">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <h6>Riwayat Konsultasi</h6>
                    <p>Lihat kembali catatan dan percakapan konsultasi sebelumnya.</p>
                    <div class="arrow">
                        Lihat riwayat <i class="bi bi-arrow-right"></i>
                    </div>
                </a>
            </div>

            <div class="col-6 col-lg-4">
                <a href="{{ route('member.profile.show') }}" class="menu-card">
                    <div class="menu-icon" style="background:rgba(241,245,249,1); color:#64748b;">
                        <i class="bi bi-person-circle"></i>
                    </div>
                    <h6>Profil Saya</h6>
                    <p>Lengkapi data diri seperti tanggal lahir, golongan darah, dan alamat.</p>
                    <div class="arrow" style="color:#64748b;">
                        Edit profil <i class="bi bi-arrow-right"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
