@extends('layouts.member')
@section('title', 'Daftar Booking')

@section('content')
<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 style="font-family: 'Sora', sans-serif; color: var(--dark); font-weight: 700;">Daftar Booking</h2>
            <hr style="width: 50px; height: 3px; background-color: var(--dark); opacity: 1; border: none;">
            <p class="text-muted">Seluruh permintaan jadwal konsultasi Anda.</p>
        </div>
        <a href="{{ route('member.booking.create') }}" class="btn text-white px-4 py-2"
           style="background-color: var(--accent); border-radius: 20px; font-weight: 500;">
            <i class="bi bi-plus-circle me-1"></i> Buat Booking Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px;">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        @forelse($bookings as $booking)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100" style="border-radius: 15px; border: none;
                     border-left: 5px solid
                        {{ $booking->status === 'pending'   ? '#ffc107' :
                          ($booking->status === 'confirmed' ? '#2bb3a7' :
                          ($booking->status === 'completed' ? '#123852' : '#dc3545')) }};">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge" style="
                                background-color: {{ $booking->status === 'pending'   ? '#fff3cd' :
                                                    ($booking->status === 'confirmed' ? '#e2f6f4' :
                                                    ($booking->status === 'completed' ? '#e7ecf0' : '#f8d7da')) }};
                                color: {{ $booking->status === 'pending'   ? '#856404' :
                                          ($booking->status === 'confirmed' ? '#2bb3a7' :
                                          ($booking->status === 'completed' ? '#123852' : '#721c24')) }};
                                border-radius: 10px; padding: 8px 12px; font-weight: 600;">
                                {{ ucfirst($booking->status) }}
                            </span>
                            <small class="text-muted">
                                <i class="bi bi-calendar3 me-1"></i>
                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                                | <i class="bi bi-clock me-1"></i>
                                {{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}
                            </small>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ $booking->doctor->image ? asset($booking->doctor->image) : asset('images/doctors/default-article.jpg') }}"
                                 class="rounded-circle me-3"
                                 style="width: 50px; height: 50px; object-fit: cover; border: 1px solid #eee;">
                            <div>
                                <h6 class="mb-0" style="color: var(--dark); font-weight: 600;">{{ $booking->doctor->name }}</h6>
                                <small style="color: var(--accent);">{{ $booking->doctor->specialization }}</small>
                            </div>
                        </div>

                        @if($booking->complaint)
                        <div class="p-3" style="background-color: #f8f9fa; border-radius: 10px;">
                            <small class="text-muted d-block mb-1"><strong>Keluhan:</strong></small>
                            <p class="mb-0" style="font-size: 0.9rem;">{{ $booking->complaint }}</p>
                        </div>
                        @endif

                        <div class="mt-3 d-flex justify-content-end">
                            <a href="{{ route('member.booking.show', $booking->id) }}"
                               class="btn btn-sm text-white px-3"
                               style="background-color: var(--accent); border-radius: 20px; font-size: 0.85rem;">
                                <i class="bi bi-eye me-1"></i>Lihat Detail
                            </a>
                        </div>
                    </div> </div> </div> @empty <div class="col-12 text-center py-5">
                <i class="bi bi-calendar-x" style="font-size:4rem; color:#cbd5e1;"></i>
                <h5 class="mt-3" style="color: var(--dark);">Belum Ada Booking</h5>
                <p class="text-muted">Buat booking pertama Anda untuk memulai konsultasi.</p>
                <a href="{{ route('member.booking.create') }}" class="btn text-white mt-3 px-4"
                   style="background-color: var(--accent); border-radius: 20px;">Buat Booking</a>
            </div>

        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $bookings->links() }}
    </div>
</div>
@endsection
