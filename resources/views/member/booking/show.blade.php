@extends('layouts.member')
@section('title', 'Detail Booking')

@section('content')
<div class="container mt-5 mb-5">
    <div class="mb-4">
        <a href="{{ route('member.booking.index') }}" class="btn btn-sm btn-outline-secondary mb-3" style="border-radius: 20px;">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Booking
        </a>
        <h2 style="font-family: 'Sora', sans-serif; color: var(--dark); font-weight: 700;">Detail Booking</h2>
        <hr style="width: 50px; height: 3px; background-color: var(--dark); opacity: 1; border: none;">
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px;">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 10px;">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card shadow-sm" style="border-radius: 16px; border: none; overflow: hidden;">
                <div class="p-4" style="background:
                    {{ $booking->status === 'pending'   ? '#fff3cd' :
                      ($booking->status === 'confirmed' ? '#e2f6f4' :
                      ($booking->status === 'completed' ? '#e7ecf0' : '#f8d7da')) }};">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-{{ $booking->status === 'pending' ? 'hourglass-split' :
                                          ($booking->status === 'confirmed' ? 'check-circle-fill' :
                                          ($booking->status === 'completed' ? 'patch-check-fill' : 'x-circle-fill')) }}"
                           style="font-size:1.5rem; color:
                            {{ $booking->status === 'pending'   ? '#856404' :
                              ($booking->status === 'confirmed' ? '#2bb3a7' :
                              ($booking->status === 'completed' ? '#123852' : '#721c24')) }};"></i>
                        <div>
                            <p class="mb-0" style="font-size:0.75rem; font-weight:600; text-transform:uppercase; letter-spacing:0.5px;
                                color: {{ $booking->status === 'pending'   ? '#856404' :
                                         ($booking->status === 'confirmed' ? '#2bb3a7' :
                                         ($booking->status === 'completed' ? '#123852' : '#721c24')) }};">
                                Status Booking
                            </p>
                            <h5 class="mb-0 fw-bold" style="color:
                                {{ $booking->status === 'pending'   ? '#856404' :
                                  ($booking->status === 'confirmed' ? '#2bb3a7' :
                                  ($booking->status === 'completed' ? '#123852' : '#721c24')) }};">
                                {{ ucfirst($booking->status) }}
                            </h5>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3" style="color: var(--dark);">Dokter</h6>
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <img src="{{ $booking->doctor->image_url }}"
                             class="rounded-circle"
                             style="width: 64px; height: 64px; object-fit: cover; border: 2px solid var(--accent);">
                        <div>
                            <h6 class="mb-0 fw-bold" style="color: var(--dark);">{{ $booking->doctor->name }}</h6>
                            <small style="color: var(--accent);">{{ $booking->doctor->specialization }}</small>
                            @if($booking->doctor->rating)
                                <div>
                                    <i class="bi bi-star-fill text-warning" style="font-size:0.75rem;"></i>
                                    <small class="text-muted">{{ $booking->doctor->rating }} / 5.0</small>
                                </div>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <h6 class="fw-bold mb-3" style="color: var(--dark);">Jadwal Konsultasi</h6>
                    <ul class="list-unstyled" style="font-size:0.875rem; color:#475569;">
                        <li class="mb-2">
                            <i class="bi bi-calendar3 me-2" style="color: var(--accent);"></i>
                            {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('l, d F Y') }}
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-clock me-2" style="color: var(--accent);"></i>
                            {{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }} WIB
                        </li>
                        @if($booking->doctorSchedule)
                        <li class="mb-2">
                            <i class="bi bi-calendar-week me-2" style="color: var(--accent);"></i>
                            Hari: {{ $booking->doctorSchedule->day }}
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            @if($booking->complaint)
            <div class="card shadow-sm mb-4" style="border-radius: 16px; border: none;">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3" style="color: var(--dark);">
                        <i class="bi bi-clipboard-pulse me-2" style="color: var(--accent);"></i>Keluhan
                    </h6>
                    <div class="p-3" style="background-color: #f8f9fa; border-radius: 12px;
                                           border-left: 4px solid var(--accent);">
                        <p class="mb-0" style="font-size: 0.9rem; color: #334155;">{{ $booking->complaint }}</p>
                    </div>
                </div>
            </div>
            @endif

            @if($booking->consultation)
            <div class="card shadow-sm mb-4" style="border-radius: 16px; border: none;">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3" style="color: var(--dark);">
                        <i class="bi bi-chat-dots-fill me-2" style="color: var(--accent);"></i>Sesi Konsultasi
                    </h6>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="badge px-3 py-2" style="border-radius:20px; font-size:0.8rem;
                                background:{{ $booking->consultation->status === 'ongoing' ? '#e2f6f4' : '#e7ecf0' }};
                                color:{{ $booking->consultation->status === 'ongoing' ? '#2bb3a7' : '#123852' }};">
                                {{ $booking->consultation->status === 'ongoing' ? 'Berlangsung' : 'Selesai' }}
                            </span>
                            <p class="mb-0 mt-2 text-muted" style="font-size:0.8rem;">
                                Dimulai: {{ $booking->consultation->started_at?->format('d M Y, H:i') ?? '-' }}
                            </p>
                        </div>
                        <a href="{{ route('member.consultations.show', $booking->consultation->id) }}"
                           class="btn btn-sm text-white px-4"
                           style="background-color: var(--accent); border-radius: 20px;">
                            <i class="bi bi-{{ $booking->consultation->status === 'ongoing' ? 'chat-dots-fill' : 'clock-history' }} me-1"></i>
                            {{ $booking->consultation->status === 'ongoing' ? 'Lanjut Chat' : 'Lihat Riwayat' }}
                        </a>
                    </div>

                    @if($booking->consultation->status === 'closed' && $booking->consultation->summary)
                    <hr>
                    <h6 class="fw-semibold mb-2" style="font-size:0.875rem; color:var(--dark);">Ringkasan Dokter</h6>
                    <p style="font-size:0.85rem; color:#334155; background:#f3faf9; border-radius:10px;
                               padding:12px; border-left:3px solid var(--accent); margin-bottom:0;">
                        {{ $booking->consultation->summary }}
                    </p>
                    @endif
                </div>
            </div>
            @endif

            <div class="card shadow-sm" style="border-radius: 16px; border: none;">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3" style="color: var(--dark);">Aksi</h6>

                    @if($booking->status === 'confirmed' && !$booking->consultation)
                        <form action="{{ route('member.consultations.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                            <button type="submit" class="btn text-white w-100 mb-2"
                                    style="background-color: var(--accent); border-radius: 20px; font-weight: 500;">
                                <i class="bi bi-play-circle-fill me-2"></i>Mulai Konsultasi
                            </button>
                        </form>
                    @elseif($booking->status === 'confirmed' && $booking->consultation)
                        <a href="{{ route('member.consultations.show', $booking->consultation->id) }}"
                           class="btn text-white w-100 mb-2"
                           style="background-color: var(--accent); border-radius: 20px; font-weight: 500;">
                            <i class="bi bi-chat-dots-fill me-2"></i>Ke Sesi Konsultasi
                        </a>
                    @elseif($booking->status === 'pending')
                        <div class="alert mb-2" style="border-radius: 12px; background:#fff3cd; color:#856404; border:none; font-size:0.875rem;">
                            <i class="bi bi-hourglass-split me-2"></i>Menunggu konfirmasi dari dokter.
                        </div>
                    @elseif($booking->status === 'completed')
                        <div class="alert mb-2" style="border-radius: 12px; background:#e2f6f4; color:#123852; border:none; font-size:0.875rem;">
                            <i class="bi bi-patch-check-fill me-2"></i>Konsultasi ini telah selesai.
                        </div>
                    @elseif($booking->status === 'cancelled')
                        <div class="alert mb-2" style="border-radius: 12px; background:#f8d7da; color:#721c24; border:none; font-size:0.875rem;">
                            <i class="bi bi-x-circle-fill me-2"></i>Booking ini dibatalkan.
                        </div>
                    @endif

                    <a href="{{ route('member.booking.create') }}" class="btn btn-outline-secondary w-100"
                       style="border-radius: 20px; font-size: 0.875rem;">
                        <i class="bi bi-plus-circle me-1"></i>Buat Booking Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
