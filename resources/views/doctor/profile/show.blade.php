@extends('layouts.doctor')
@section('title', 'Profil Saya')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-semibold mb-1" style="color:#0f172a;">Profil Saya</h5>
        <p class="text-muted mb-0" style="font-size:0.85rem;">Informasi profil dan data praktik Anda.</p>
    </div>
    <a href="{{ route('doctor.profile.edit') }}" class="btn btn-primary" style="border-radius:8px;">
        <i class="bi bi-pencil-fill me-1"></i>Edit Profil
    </a>
</div>

<div class="row g-4">
    {{-- Profile Card --}}
    <div class="col-lg-4">
        <div class="card-custom p-4 text-center">
            @if($doctor->image)
                <img src="{{ asset('storage/' . $doctor->image) }}"
                     class="rounded-circle mb-3 mx-auto d-block"
                     style="width:100px; height:100px; object-fit:cover; border:3px solid var(--accent);">
            @else
                <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center mb-3 mx-auto"
                     style="width:100px; height:100px; font-size:2.5rem;">
                    <i class="bi bi-person-fill"></i>
                </div>
            @endif
            <h5 class="fw-bold mb-1" style="color:#0f172a;">{{ $doctor->name }}</h5>
            <p class="text-muted mb-2" style="font-size:0.875rem;">{{ $doctor->specialization }}</p>
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2" style="border-radius:10px; font-size:0.8rem;">
                <i class="bi bi-award-fill me-1"></i>{{ $doctor->experience_years }} Tahun Pengalaman
            </span>
            @if($doctor->rating)
                <div class="mt-2">
                    <i class="bi bi-star-fill text-warning"></i>
                    <span class="fw-semibold ms-1" style="font-size:0.875rem;">{{ number_format($doctor->rating, 1) }}</span>
                </div>
            @endif
        </div>
    </div>

    {{-- Details --}}
    <div class="col-lg-8">
        <div class="card-custom p-4">
            <h6 class="fw-semibold mb-4" style="color:#0f172a;">Informasi Detail</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label text-muted" style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.5px;">Nama Lengkap</label>
                    <p class="fw-semibold mb-0" style="color:#0f172a;">{{ $doctor->name }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted" style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.5px;">Spesialisasi</label>
                    <p class="fw-semibold mb-0" style="color:#0f172a;">{{ $doctor->specialization }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted" style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.5px;">Email</label>
                    <p class="fw-semibold mb-0" style="color:#0f172a;">{{ $user->email }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted" style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.5px;">No. Telepon</label>
                    <p class="fw-semibold mb-0" style="color:#0f172a;">{{ $user->phone_number ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted" style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.5px;">Jenis Kelamin</label>
                    <p class="fw-semibold mb-0" style="color:#0f172a;">
                        {{ $doctor->gender === 'male' ? 'Laki-laki' : ($doctor->gender === 'female' ? 'Perempuan' : '-') }}
                    </p>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted" style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.5px;">Harga Konsultasi</label>
                    <p class="fw-semibold mb-0" style="color:#0f172a;">Rp {{ number_format($doctor->price, 0, ',', '.') }}</p>
                </div>
                <div class="col-12">
                    <label class="form-label text-muted" style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.5px;">Alamat</label>
                    <p class="fw-semibold mb-0" style="color:#0f172a;">{{ $doctor->address ?? '-' }}</p>
                </div>
                @if($doctor->bio)
                <div class="col-12">
                    <label class="form-label text-muted" style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.5px;">Bio</label>
                    <p style="color:#334155; font-size:0.875rem; background:#f8fafc; border-radius:10px; padding:14px; margin:0; border-left:4px solid var(--accent);">
                        {{ $doctor->bio }}
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
