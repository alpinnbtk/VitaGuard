@extends('layouts.admin')
@section('title', 'Profil Dokter')

@section('content')
<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('admin.doctors.index') }}" class="btn btn-sm btn-light" style="border-radius:8px;">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h5 class="fw-semibold mb-0" style="color:#0f172a;">Profil Dokter</h5>
        <p class="text-muted mb-0" style="font-size:0.8rem;">Detail informasi dokter</p>
    </div>
    <div class="ms-auto d-flex gap-2">
        <a href="{{ route('admin.doctors.edit', $doctor) }}" class="btn btn-sm btn-outline-warning" style="border-radius:8px;">
            <i class="bi bi-pencil-square me-1"></i>Edit
        </a>
        <form action="{{ route('admin.doctors.destroy', $doctor) }}" method="POST" class="m-0"
              onsubmit="return confirm('Yakin ingin menghapus dokter ini?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius:8px;">
                <i class="bi bi-trash3 me-1"></i>Hapus
            </button>
        </form>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card-custom p-4 text-center mb-4">
            @if($doctor->image)
                <img src="{{ $doctor->image_url }}"
                     class="rounded-circle mb-3"
                     style="width:100px; height:100px; object-fit:cover; border:3px solid var(--accent);">
            @else
                <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center
                            justify-content-center mx-auto mb-3"
                     style="width:100px; height:100px; font-size:2.5rem;">
                    <i class="bi bi-person-circle"></i>
                </div>
            @endif
            <h5 class="fw-bold mb-1" style="color:#0f172a;">{{ $doctor->name }}</h5>
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2" style="border-radius:20px; font-size:0.8rem;">
                {{ $doctor->specialization }}
            </span>
            @if($doctor->rating)
            <div class="mt-2">
                <i class="bi bi-star-fill text-warning"></i>
                <span class="fw-semibold ms-1">{{ $doctor->rating }}</span>
                <small class="text-muted">/ 5.0</small>
            </div>
            @endif
        </div>

        @if($doctor->user)
        <div class="card-custom p-4">
            <h6 class="fw-semibold mb-3" style="color:#0f172a;">Akun Pengguna</h6>
            <ul class="list-unstyled mb-0" style="font-size:0.875rem; color:#475569;">
                <li class="mb-2">
                    <i class="bi bi-person me-2 text-primary"></i>{{ $doctor->user->name }}
                </li>
                <li class="mb-2">
                    <i class="bi bi-envelope me-2 text-primary"></i>{{ $doctor->user->email }}
                </li>
                <li>
                    <i class="bi bi-shield-check me-2 text-success"></i>
                    <span class="badge bg-success bg-opacity-10 text-success" style="border-radius:6px; font-size:0.75rem;">
                        Akun Aktif
                    </span>
                </li>
            </ul>
        </div>
        @endif
    </div>

    <div class="col-lg-8">
        <div class="card-custom p-4 mb-4">
            <h6 class="fw-semibold mb-4" style="color:#0f172a; border-bottom:1px solid #e2e8f0; padding-bottom:12px;">
                <i class="bi bi-info-circle me-2 text-primary"></i>Informasi Lengkap
            </h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <p class="mb-1 text-muted" style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.5px; font-weight:600;">Email</p>
                    <p class="mb-0" style="font-size:0.9rem; color:#0f172a;">{{ $doctor->email }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted" style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.5px; font-weight:600;">No. Telepon</p>
                    <p class="mb-0" style="font-size:0.9rem; color:#0f172a;">{{ $doctor->phone_number }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted" style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.5px; font-weight:600;">Jenis Kelamin</p>
                    <p class="mb-0" style="font-size:0.9rem; color:#0f172a;">
                        {{ $doctor->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted" style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.5px; font-weight:600;">Pengalaman</p>
                    <p class="mb-0" style="font-size:0.9rem; color:#0f172a;">{{ $doctor->experience_years }} tahun</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted" style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.5px; font-weight:600;">Harga Konsultasi</p>
                    <p class="mb-0 fw-semibold" style="font-size:0.9rem; color:#0ea5e9;">
                        Rp {{ number_format($doctor->price, 0, ',', '.') }}
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted" style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.5px; font-weight:600;">Rating</p>
                    <p class="mb-0" style="font-size:0.9rem; color:#0f172a;">
                        @if($doctor->rating)
                            <i class="bi bi-star-fill text-warning me-1"></i>{{ $doctor->rating }} / 5.0
                        @else
                            <span class="text-muted">Belum ada rating</span>
                        @endif
                    </p>
                </div>
                @if($doctor->address)
                <div class="col-12">
                    <p class="mb-1 text-muted" style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.5px; font-weight:600;">Alamat</p>
                    <p class="mb-0" style="font-size:0.9rem; color:#0f172a;">{{ $doctor->address }}</p>
                </div>
                @endif
            </div>
        </div>

        @if($doctor->transactions && $doctor->transactions->count() > 0)
        <div class="card-custom">
            <div class="card-header">
                <h5><i class="bi bi-receipt me-2"></i>Riwayat Transaksi</h5>
                <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-1" style="border-radius:8px;">
                    {{ $doctor->transactions->count() }} transaksi
                </span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Member</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($doctor->transactions->take(5) as $trx)
                        <tr>
                            <td style="font-size:0.875rem;">{{ $trx->user->name ?? '-' }}</td>
                            <td style="font-size:0.875rem;">
                                {{ $trx->created_at?->format('d M Y') ?? '-' }}
                            </td>
                            <td>
                                <span class="badge bg-success bg-opacity-10 text-success badge-status">
                                    {{ ucfirst($trx->status ?? 'selesai') }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
