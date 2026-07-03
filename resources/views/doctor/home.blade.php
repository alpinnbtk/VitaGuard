@extends('layouts.doctor')
@section('title', 'Beranda')

@section('content')

{{-- Greeting --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h5 class="fw-semibold mb-1" style="color:#0f172a;">
            Selamat datang, {{ Auth::user()->name }} 👋
        </h5>
        <p class="text-muted mb-0" style="font-size:0.85rem;">
            Berikut ringkasan aktivitas konsultasi Anda hari ini.
        </p>
    </div>
</div>

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted small mb-1">Booking Masuk</p>
                    <h3 class="fw-bold mb-0">{{ $totalBookings ?? 0 }}</h3>
                </div>
                <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                    <i class="bi bi-calendar-check-fill"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted small mb-1">Konsultasi Aktif</p>
                    <h3 class="fw-bold mb-0">{{ $activeConsultations ?? 0 }}</h3>
                </div>
                <div class="stat-icon bg-success bg-opacity-10 text-success">
                    <i class="bi bi-chat-dots-fill"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted small mb-1">Konsultasi Selesai</p>
                    <h3 class="fw-bold mb-0">{{ $completedConsultations ?? 0 }}</h3>
                </div>
                <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                    <i class="bi bi-clock-history"></i>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Menu Cards --}}
<p style="font-size:0.7rem; font-weight:600; text-transform:uppercase; letter-spacing:1.5px; color:#94a3b8;" class="mb-3">
    Menu Utama
</p>

<div class="row g-3 mb-4">
    {{-- Daftar Booking --}}
    <div class="col-md-6 col-lg-3">
        <a href="{{ route('doctor.bookings.index') }}" class="menu-card">
            <div class="menu-icon icon-blue">
                <i class="bi bi-calendar-check-fill"></i>
            </div>
            <h6>Daftar Booking</h6>
            <p>Lihat seluruh permintaan booking konsultasi yang masuk dari member.</p>
            <div class="arrow">
                Lihat booking <i class="bi bi-arrow-right"></i>
            </div>
        </a>
    </div>

    {{-- Konsultasi Online --}}
    <div class="col-md-6 col-lg-3">
        <a href="{{ route('doctor.consultations.index') }}" class="menu-card">
            <div class="menu-icon icon-green">
                <i class="bi bi-chat-dots-fill"></i>
            </div>
            <h6>Konsultasi Online</h6>
            <p>Balas pesan member dan tutup sesi konsultasi yang telah selesai.</p>
            <div class="arrow">
                Mulai konsultasi <i class="bi bi-arrow-right"></i>
            </div>
        </a>
    </div>

    {{-- Riwayat Konsultasi --}}
    <div class="col-md-6 col-lg-3">
        <a href="{{ route('doctor.history.index') }}" class="menu-card">
            <div class="menu-icon icon-amber">
                <i class="bi bi-clock-history"></i>
            </div>
            <h6>Riwayat Konsultasi</h6>
            <p>Lihat daftar pasien dan riwayat konsultasi yang pernah ditangani.</p>
            <div class="arrow">
                Lihat riwayat <i class="bi bi-arrow-right"></i>
            </div>
        </a>
    </div>

    {{-- Profil Saya --}}
    <div class="col-md-6 col-lg-3">
        <a href="{{ route('doctor.profile.show') }}" class="menu-card">
            <div class="menu-icon icon-violet">
                <i class="bi bi-person-circle"></i>
            </div>
            <h6>Profil Saya</h6>
            <p>Lihat dan perbarui informasi profil serta data praktik Anda.</p>
            <div class="arrow">
                Edit profil <i class="bi bi-arrow-right"></i>
            </div>
        </a>
    </div>
</div>

{{-- Booking Terbaru --}}
<div class="card-custom">
    <div class="card-header">
        <h5><i class="bi bi-calendar-check me-2"></i>Booking Terbaru</h5>
        <a href="{{ route('doctor.bookings.index') }}" class="btn btn-sm btn-outline-primary">
            Lihat Semua
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Member</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentBookings ?? [] as $booking)
                <tr>
                    <td>{{ $booking->user->name ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}</td>
                    <td>
                        @switch($booking->status)
                            @case('confirmed')
                                <span class="badge bg-primary badge-status">Dikonfirmasi</span>
                                @break
                            @case('pending')
                                <span class="badge bg-warning text-dark badge-status">Menunggu</span>
                                @break
                            @case('completed')
                                <span class="badge bg-success badge-status">Selesai</span>
                                @break
                            @case('cancelled')
                                <span class="badge bg-danger badge-status">Dibatalkan</span>
                                @break
                        @endswitch
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-3">
                        Belum ada booking masuk
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
