@extends('layouts.member')

@section('content')
<div class="container mt-5 mb-5">
    <a href="{{ route('member.doctors.index') }}" class="btn btn-outline-secondary mb-4" style="border-radius:20px;">
        <i class="bi bi-arrow-left"></i> Kembali ke Direktori
    </a>

    <div class="card shadow-sm" style="border-radius: 15px; border: none; overflow: hidden;">
        <div class="row g-0">
            <div class="col-md-4 text-center p-4 d-flex align-items-center justify-content-center" style="background-color: var(--surface);">
                <img src="{{ $doctor->image ?? asset('images/doctors/default-article.jpg') }}" alt="{{ $doctor->name }}" class="img-fluid shadow-sm" style="width: 250px; height: 250px; object-fit: cover; border-radius: 15px; border: 4px solid white;">
            </div>
            
            <div class="col-md-8">
                <div class="card-body p-4 p-md-5">
                    <h2 style="font-family: 'Sora', sans-serif; color: var(--dark); font-weight: 700; margin-bottom: 0.5rem;">
                        {{ $doctor->name }}
                    </h2>
                    
                    <h5 style="color: var(--accent); font-weight: 600; margin-bottom: 1.5rem;">{{ $doctor->specialization }}</h5>
                    
                    <div class="d-flex align-items-start mb-3 text-muted" style="font-size: 0.95rem;">
                        <i class="bi bi-geo-alt-fill me-2 mt-1" style="color: #4a6572;"></i>
                        <span>{{ $doctor->address ?? 'Klinik VitaGuard Terdekat' }}</span>
                    </div>

                    <div class="d-flex align-items-start mb-4 text-muted" style="font-size: 0.95rem;">
                        <i class="bi bi-briefcase-fill me-2 mt-1" style="color: #4a6572;"></i>
                        <span>Pengalaman: {{ $doctor->experience_years }} Tahun</span>
                    </div>
                    
                    <hr>

                    <h6 style="color: var(--dark); font-weight: 700; font-family: 'Sora', sans-serif; margin-top: 1.5rem;">Biografi</h6>
                    <div class="article-content mt-2" style="line-height: 1.8; color: #4a5568;">
                        {!! nl2br(e($doctor->bio ?? 'Belum ada biografi yang ditambahkan.')) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
