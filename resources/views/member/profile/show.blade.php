@extends('layouts.member')

@section('content')
<div class="container mt-5 mb-5">
    <div class="mb-4">
        <h2 style="font-family: 'Sora', sans-serif; color: var(--dark); font-weight: 700;">Profil Saya</h2>
        <hr style="width: 50px; height: 3px; background-color: var(--dark); opacity: 1; border: none;">
        <p class="text-muted">Kelola informasi pribadi dan data keanggotaan Anda di VitaGuard.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm text-center p-4 h-100" style="border-radius: 15px; border: none; background-color: var(--dark);">
                <div class="mb-3 mt-4">
                    <div style="width: 120px; height: 120px; background-color: rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; border: 4px solid var(--accent);">
                        <i class="bi bi-person-fill text-white" style="font-size: 4rem;"></i>
                    </div>
                </div>
                <h4 class="mb-1 text-white" style="font-family: 'Sora', sans-serif; font-weight: 600;">{{ $user->name }}</h4>
                <p style="color: var(--accent); font-weight: 500;">Member VitaGuard</p>
                <div class="mt-auto pt-4">
                    <p class="text-white-50 small mb-0">Bergabung sejak {{ $user->created_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-4">
            <div class="card shadow-sm h-100" style="border-radius: 15px; border: none;">
                <div class="card-header bg-white p-4" style="border-bottom: 2px solid #f8f9fa;">
                    <h5 class="mb-0" style="color: var(--dark); font-weight: 600;">Data Registrasi & Personal</h5>
                </div>
                <div class="card-body p-4 p-md-5">
                    
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted"><strong>Nama Lengkap</strong></div>
                        <div class="col-sm-8" style="color: var(--dark); font-weight: 500;">{{ $user->name }}</div>
                    </div>
                    <hr style="border-color: #eee;">

                    <div class="row mb-4 mt-4">
                        <div class="col-sm-4 text-muted"><strong>Username</strong></div>
                        <div class="col-sm-8" style="color: var(--dark); font-weight: 500;">{{ $user->username }}</div>
                    </div>
                    <hr style="border-color: #eee;">

                    <div class="row mb-4 mt-4">
                        <div class="col-sm-4 text-muted"><strong>Email</strong></div>
                        <div class="col-sm-8" style="color: var(--dark); font-weight: 500;">{{ $user->email }}</div>
                    </div>
                    <hr style="border-color: #eee;">

                    <div class="row mb-4 mt-4">
                        <div class="col-sm-4 text-muted"><strong>Nomor HP</strong></div>
                        <div class="col-sm-8" style="color: var(--dark); font-weight: 500;">{{ $user->phone_number ?? '-' }}</div>
                    </div>
                    
                    @if($user->member)
                    <hr style="border-color: #eee;">

                    <div class="row mb-4 mt-4">
                        <div class="col-sm-4 text-muted"><strong>Jenis Kelamin</strong></div>
                        <div class="col-sm-8" style="color: var(--dark); font-weight: 500;">
                            @if($user->member->gender === 'male') Laki-Laki
                            @elseif($user->member->gender === 'female') Perempuan
                            @else - 
                            @endif
                        </div>
                    </div>
                    <hr style="border-color: #eee;">

                    <div class="row mb-4 mt-4">
                        <div class="col-sm-4 text-muted"><strong>Tanggal Lahir</strong></div>
                        <div class="col-sm-8" style="color: var(--dark); font-weight: 500;">
                            {{ $user->member->date_of_birth ? \Carbon\Carbon::parse($user->member->date_of_birth)->format('d M Y') : '-' }}
                        </div>
                    </div>
                    <hr style="border-color: #eee;">

                    <div class="row mb-4 mt-4">
                        <div class="col-sm-4 text-muted"><strong>Golongan Darah</strong></div>
                        <div class="col-sm-8" style="color: var(--dark); font-weight: 500;">{{ $user->member->blood_type ?? '-' }}</div>
                    </div>
                    <hr style="border-color: #eee;">

                    <div class="row mb-2 mt-4">
                        <div class="col-sm-4 text-muted"><strong>Alamat</strong></div>
                        <div class="col-sm-8" style="color: var(--dark); font-weight: 500;">{{ $user->member->address ?? '-' }}</div>
                    </div>
                    @endif

                    <div class="mt-5 text-end">
                        <a href="{{ route('member.profile.edit') }}" class="btn text-white px-4" style="background-color: var(--accent); border-radius: 20px;">
                            <i class="bi bi-pencil-square me-2"></i>Edit Profil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
