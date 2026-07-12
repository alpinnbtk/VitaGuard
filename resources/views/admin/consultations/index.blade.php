@extends('layouts.admin')
@section('title', 'Data Konsultasi')

@section('content')
<div class="card-custom">
    <div class="card-header">
        <h5><i class="bi bi-chat-dots-fill me-2"></i>Data Konsultasi Online</h5>
        <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2" style="border-radius:8px; font-size:0.8rem;">
            {{ $consultations->total() }} Konsultasi
        </span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Member</th>
                    <th>Dokter</th>
                    <th>Tanggal Booking</th>
                    <th>Dimulai</th>
                    <th>Selesai</th>
                    <th>Status</th>
                    <th class="text-center" width="100">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($consultations as $consultation)
                <tr>
                    <td>
                        <div class="fw-semibold" style="font-size:0.875rem; color:#0f172a;">
                            {{ $consultation->booking->user->name ?? '-' }}
                        </div>
                        <small class="text-muted">{{ $consultation->booking->user->email ?? '' }}</small>
                    </td>
                    <td>
                        <div style="font-size:0.875rem;">{{ $consultation->booking->doctor->name ?? '-' }}</div>
                        <small class="text-muted">{{ $consultation->booking->doctor->specialization ?? '' }}</small>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($consultation->booking->booking_date)->format('d M Y') }}</td>
                    <td>{{ $consultation->started_at?->format('d M Y, H:i') ?? '-' }}</td>
                    <td>{{ $consultation->ended_at?->format('d M Y, H:i') ?? '-' }}</td>
                    <td>
                        @if($consultation->status === 'ongoing')
                            <span class="badge bg-success badge-status">Berlangsung</span>
                        @else
                            <span class="badge bg-secondary badge-status">Selesai</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.consultations.show', $consultation->id) }}"
                           class="btn btn-sm btn-outline-primary" style="border-radius:8px; font-size:0.75rem; padding:4px 8px;">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">Belum ada data konsultasi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $consultations->links() }}
</div>
@endsection
