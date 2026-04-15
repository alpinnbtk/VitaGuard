@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<!-- Stats -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
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
    <div class="col-md-3">
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
    <div class="col-md-3">
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
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted small mb-1">Konsultasi</p>
                    <h3 class="fw-bold mb-0">{{ $totalTransactions }}</h3>
                </div>
                <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                    <i class="bi bi-receipt-cutoff"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Transactions -->
<div class="card-custom">
    <div class="card-header">
        <h5><i class="bi bi-clock-history me-2"></i>Konsultasi Terbaru</h5>
        <a href="{{ route('admin.transactions.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Member</th>
                    <th>Dokter</th>
                    <th>Tanggal</th>
                    <th>Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentTransactions as $t)
                <tr>
                    <td>{{ $t->user->name ?? '-' }}</td>
                    <td>{{ $t->doctor->name ?? '-' }}</td>
                    <td>{{ $t->consultation_date->format('d M Y') }}</td>
                    <td>Rp {{ number_format($t->total_price, 0, ',', '.') }}</td>
                    <td>
                        @switch($t->status)
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
