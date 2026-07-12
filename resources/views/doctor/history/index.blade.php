@extends('layouts.doctor')
@section('title', 'Riwayat Konsultasi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-semibold mb-1" style="color:#0f172a;">Riwayat Konsultasi</h5>
        <p class="text-muted mb-0" style="font-size:0.85rem;">Daftar seluruh pasien yang telah Anda tangani.</p>
    </div>
    <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2" style="border-radius:10px; font-size:0.8rem;">
        <i class="bi bi-archive me-1"></i>{{ $consultations->total() }} Riwayat
    </span>
</div>

@if($consultations->isEmpty())
    <div class="card-custom p-5 text-center">
        <i class="bi bi-clock-history" style="font-size:3.5rem; color:#cbd5e1;"></i>
        <h6 class="fw-semibold mt-3 mb-1" style="color:#0f172a;">Belum Ada Riwayat</h6>
        <p class="text-muted" style="font-size:0.85rem;">Riwayat konsultasi yang selesai akan muncul di sini.</p>
    </div>
@else
    <div class="card-custom">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Pasien</th>
                        <th>Tanggal Booking</th>
                        <th>Dimulai</th>
                        <th>Selesai</th>
                        <th>Ringkasan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($consultations as $consultation)
                        <tr>
                            <td>
                                <div class="fw-semibold" style="color:#0f172a; font-size:0.875rem;">
                                    {{ $consultation->booking->user->name ?? '-' }}
                                </div>
                                <small class="text-muted">{{ $consultation->booking->user->email ?? '' }}</small>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($consultation->booking->booking_date)->format('d M Y') }}</td>
                            <td>{{ $consultation->started_at?->format('d M Y, H:i') ?? '-' }}</td>
                            <td>{{ $consultation->ended_at?->format('d M Y, H:i') ?? '-' }}</td>
                            <td style="max-width:200px;">
                                @if($consultation->summary)
                                    <span style="font-size:0.8rem; color:#475569;" class="text-truncate d-block">
                                        {{ Str::limit($consultation->summary, 60) }}
                                    </span>
                                @else
                                    <span class="text-muted" style="font-size:0.8rem;">—</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('doctor.consultations.show', $consultation->id) }}"
                                   class="btn btn-sm btn-outline-primary" style="border-radius:8px; font-size:0.8rem;">
                                    <i class="bi bi-eye me-1"></i>Detail
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
