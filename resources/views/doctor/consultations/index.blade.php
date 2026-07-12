@extends('layouts.doctor')
@section('title', 'Konsultasi Online')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-semibold mb-1" style="color:#0f172a;">Konsultasi Online</h5>
        <p class="text-muted mb-0" style="font-size:0.85rem;">Daftar sesi konsultasi yang sedang aktif dari pasien Anda.</p>
    </div>
    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2" style="border-radius:10px; font-size:0.8rem;">
        <i class="bi bi-circle-fill me-1" style="font-size:0.5rem;"></i>
        {{ $consultations->total() }} Sesi Aktif
    </span>
</div>

@if($consultations->isEmpty())
    <div class="card-custom p-5 text-center">
        <i class="bi bi-chat-square-dots" style="font-size:3.5rem; color:#cbd5e1;"></i>
        <h6 class="fw-semibold mt-3 mb-1" style="color:#0f172a;">Tidak Ada Konsultasi Aktif</h6>
        <p class="text-muted" style="font-size:0.85rem;">Saat ini tidak ada sesi konsultasi yang berlangsung.</p>
    </div>
@else
    <div class="card-custom">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Pasien</th>
                        <th>Tanggal Booking</th>
                        <th>Waktu</th>
                        <th>Dimulai</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($consultations as $consultation)
                        <tr>
                            <td>
                                <div class="fw-semibold" style="font-size:0.875rem; color:#0f172a;">
                                    {{ $consultation->booking->user->name ?? '-' }}
                                </div>
                                <small class="text-muted">{{ $consultation->booking->user->email ?? '' }}</small>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($consultation->booking->booking_date)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($consultation->booking->booking_time)->format('H:i') }}</td>
                            <td>{{ $consultation->started_at?->format('d M Y, H:i') ?? '-' }}</td>
                            <td>
                                <span class="badge bg-success bg-opacity-10 text-success badge-status">
                                    <i class="bi bi-circle-fill me-1" style="font-size:0.4rem;"></i>Berlangsung
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('doctor.consultations.show', $consultation->id) }}"
                                   class="btn btn-sm btn-primary" style="border-radius:8px; font-size:0.8rem;">
                                    <i class="bi bi-chat-dots-fill me-1"></i>Buka Chat
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $consultations->links() }}
    </div>
@endif
@endsection
