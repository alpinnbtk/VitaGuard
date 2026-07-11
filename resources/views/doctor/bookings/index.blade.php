@extends('layouts.doctor')
@section('title', 'Daftar Booking')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-semibold mb-1" style="color:#0f172a;">Daftar Booking</h5>
        <p class="text-muted mb-0" style="font-size:0.85rem;">Konfirmasi atau tolak permintaan jadwal konsultasi dari pasien Anda.</p>
    </div>
</div>

@if($bookings->isEmpty())
    <div class="card-custom p-5 text-center">
        <i class="bi bi-calendar-x" style="font-size:3.5rem; color:#cbd5e1;"></i>
        <h6 class="fw-semibold mt-3 mb-1" style="color:#0f172a;">Belum Ada Booking</h6>
        <p class="text-muted" style="font-size:0.85rem;">Belum ada permintaan jadwal dari pasien.</p>
    </div>
@else
    <div class="card-custom">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Pasien</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Keluhan</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <td>
                                <div class="fw-semibold" style="color:#0f172a; font-size:0.875rem;">
                                    {{ $booking->user->name ?? '-' }}
                                </div>
                                <small class="text-muted">{{ $booking->user->email ?? '' }}</small>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}</td>
                            <td style="max-width:200px;">
                                <span style="font-size:0.8rem; color:#475569;">
                                    {{ Str::limit($booking->complaint ?? '—', 50) }}
                                </span>
                            </td>
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
                                                    <td class="text-center">
                                @if($booking->status === 'pending')
                                    <div class="d-flex gap-2 justify-content-center">
                                        <form action="{{ route('doctor.bookings.confirm', $booking->id) }}" method="POST"
                                              onsubmit="return confirm('Konfirmasi booking dari {{ $booking->user->name }}?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-success"
                                                    style="border-radius:8px; font-size:0.8rem;">
                                                <i class="bi bi-check-circle-fill me-1"></i>Konfirmasi
                                            </button>
                                        </form>

                                        <form action="{{ route('doctor.bookings.cancel', $booking->id) }}" method="POST"
                                              onsubmit="return confirm('Batalkan booking dari {{ $booking->user->name }}?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    style="border-radius:8px; font-size:0.8rem;">
                                                <i class="bi bi-x-circle-fill me-1"></i>Tolak
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $bookings->links() }}
    </div>
@endif
@endsection
