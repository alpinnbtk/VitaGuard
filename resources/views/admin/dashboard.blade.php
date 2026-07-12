@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
    {{-- Stat Cards Row 1: Master Data --}}
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted small mb-1">Total Member</p>
                        <h3 class="fw-bold mb-0">{{ $totalMembers }}</h3>
                    </div>
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted small mb-1">Total Dokter</p>
                        <h3 class="fw-bold mb-0">{{ $totalDoctors }}</h3>
                    </div>
                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                        <i class="bi bi-hospital"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted small mb-1">Total Artikel</p>
                        <h3 class="fw-bold mb-0">{{ $totalArticles }}</h3>
                    </div>
                    <div class="stat-icon bg-info bg-opacity-10 text-info">
                        <i class="bi bi-newspaper"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Stat Cards Row 2: Booking & Consultation Stats --}}
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted small mb-1">Total Konsultasi</p>
                        <h3 class="fw-bold mb-0">{{ $totalBookings }}</h3>
                        <small class="text-muted">Seluruh permintaan jadwal</small>
                    </div>
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-calendar-check-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted small mb-1">Konsultasi Berlangsung</p>
                        <h3 class="fw-bold mb-0">{{ $ongoingConsultations }}</h3>
                        <small class="text-muted">Sesi aktif saat ini</small>
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
                        <h3 class="fw-bold mb-0">{{ $completedConsultations }}</h3>
                        <small class="text-muted">Telah ditutup oleh dokter</small>
                    </div>
                    <div class="stat-icon" style="background:rgba(139,92,246,0.1); color:#8b5cf6;">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Bookings Table --}}
    <div class="card-custom">
        <div class="card-header">
            <h5><i class="bi bi-calendar-check me-2"></i>Konsultasi Terbaru</h5>
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Member</th>
                        <th>Dokter</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentBookings as $booking)
                        <tr>
                            <td>{{ $booking->user->name ?? '-' }}</td>
                            <td>{{ $booking->doctor->name ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}</td>
                            <td>
                                @switch($booking->status)
                                    @case('completed')
                                        <span class="badge bg-success badge-status">Selesai</span>
                                    @break

                                    @case('confirmed')
                                        <span class="badge bg-primary badge-status">Dikonfirmasi</span>
                                    @break

                                    @case('pending')
                                        <span class="badge bg-warning text-dark badge-status">Menunggu</span>
                                    @break

                                    @case('cancelled')
                                        <span class="badge bg-danger badge-status">Dibatalkan</span>
                                    @break
                                @endswitch
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3">Belum ada data konsultasi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
