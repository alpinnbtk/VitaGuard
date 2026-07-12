@extends('layouts.member')

@section('content')
<div class="container mt-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <div class="mb-3 mb-md-0">
            <h2 style="font-family: 'Sora', sans-serif; color: var(--dark); font-weight: 700;">Direktori Dokter</h2>
            <hr style="width: 50px; height: 3px; background-color: var(--dark); opacity: 1; border: none;">
            <p class="text-muted mb-0">Temukan dokter spesialis yang sesuai dengan kebutuhanmu.</p>
        </div>
        
        <form action="{{ route('member.doctors.index') }}" method="GET" class="d-flex mt-2 mt-md-0">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari nama atau spesialis..." value="{{ request('search') }}" style="border-radius: 20px;">
            <button type="submit" class="btn text-white" style="background-color: var(--accent); border-radius: 20px; padding: 8px 20px;">Cari</button>
        </form>
    </div>

    <div class="row">
        @forelse ($doctors as $doctor)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100" style="border-radius: 12px; border: 1px solid #e0e0e0; transition: transform 0.2s;">
                    <div class="card-body d-flex align-items-center">
                        
                        <div class="me-4 flex-shrink-0">
                            <img src="{{ $doctor->image ?? asset('images/doctors/default-article.jpg') }}" 
                                 alt="{{ $doctor->name }}" 
                                 style="width: 100px; height: 100px; object-fit: cover; border-radius: 12px; border: 1px solid #f0f0f0;">
                        </div>
                        
                        <div class="flex-grow-1">
                            <h5 class="mb-1" style="font-weight: 700; color: var(--dark);">{{ $doctor->name }}</h5>
                            <p class="mb-2" style="font-size: 0.95rem; color: var(--accent); font-weight: 600;">{{ $doctor->specialization }}</p>
                            
                            <p class="mb-3 text-muted d-flex align-items-start" style="font-size: 0.85rem; line-height: 1.4;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill me-2 mt-1 flex-shrink-0" viewBox="0 0 16 16" style="color: #4a6572;">
                                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                                </svg>
                                {{ $doctor->address ?? 'Klinik VitaGuard Terdekat' }}
                            </p>
                            
                            <a href="{{ route('member.doctors.show', $doctor->id) }}" class="btn btn-sm text-white px-4" style="background-color: var(--accent-dark); border-radius: 20px; font-weight: 500;">Lihat Profil</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center mt-5">
                <p class="text-muted">Belum ada data dokter yang tersedia.</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4 mb-5">
        {{ $doctors->links() }}
    </div>
</div>
@endsection
