@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
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

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted small mb-1">Jumlah Booking Konsultasi</p>
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

    <div class="row g-4 mt-2">
        <div class="col-md-5">
            <div class="card-custom">
                <div class="card-header">
                    <h5><i class="bi bi-pie-chart-fill me-2"></i>Status Booking</h5>
                </div>
                <div class="p-4 d-flex justify-content-center align-items-center" style="min-height:300px;">
                    <canvas id="bookingStatusChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card-custom">
                <div class="card-header">
                    <h5><i class="bi bi-bar-chart-fill me-2"></i>Tren Booking (6 Bulan Terakhir)</h5>
                </div>
                <div class="p-4">
                    <canvas id="monthlyBookingChart" style="max-height:280px;"></canvas>
                </div>
            </div>
        </div>
    </div>

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

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        new Chart(document.getElementById('bookingStatusChart'), {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Dikonfirmasi', 'Selesai', 'Dibatalkan'],
                datasets: [{
                    data: [
                        {{ $bookingStatusData['pending']   ?? 0 }},
                        {{ $bookingStatusData['confirmed'] ?? 0 }},
                        {{ $bookingStatusData['completed'] ?? 0 }},
                        {{ $bookingStatusData['cancelled'] ?? 0 }},
                    ],
                    backgroundColor: ['#f59e0b', '#0ea5e9', '#22c55e', '#ef4444'],
                    borderWidth: 3,
                    borderColor: '#ffffff',
                    hoverOffset: 6,
                }]
            },
            options: {
                responsive: true,
                cutout: '68%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { font: { family: 'Inter', size: 12 }, padding: 16 }
                    }
                }
            }
        });

        new Chart(document.getElementById('monthlyBookingChart'), {
            type: 'line',
            data: {
                labels:   {!! json_encode($monthlyBookings->pluck('month')) !!},
                datasets: [{
                    label: 'Jumlah Booking',
                    data:  {!! json_encode($monthlyBookings->pluck('total')) !!},
                    backgroundColor: 'rgba(14, 165, 233, 0.08)',
                    borderColor: '#0ea5e9',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#0ea5e9',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    fill: true,
                    tension: 0.4,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0, font: { family: 'Inter', size: 12 } },
                        grid: { color: '#f1f5f9' }
                    },
                    x: {
                        ticks: { font: { family: 'Inter', size: 12 } },
                        grid: { display: false }
                    }
                }
            }
        });
    </script>
    @endpush
@endsection
