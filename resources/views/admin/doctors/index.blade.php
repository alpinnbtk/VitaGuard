@extends('layouts.admin')
@section('title', 'Daftar Dokter')

@section('content')
<div class="card-custom">
    <div class="card-header">
        <h5><i class="bi bi-hospital me-2"></i>Daftar Dokter</h5>
        <a href="{{ route('admin.doctors.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Tambah Dokter
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th width="50">#</th>
                    <th>Nama</th>
                    <th>Spesialisasi</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Pengalaman</th>
                    <th>Harga</th>
                    <th>Rating</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($doctors as $i => $doctor)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td class="fw-medium">{{ $doctor->name }}</td>
                    <td><span class="badge bg-primary bg-opacity-10 text-primary badge-status">{{ $doctor->specialization }}</span></td>
                    <td>{{ $doctor->email }}</td>
                    <td>{{ $doctor->phone_number }}</td>
                    <td>{{ $doctor->experience_years }} tahun</td>
                    <td>Rp {{ number_format($doctor->price, 0, ',', '.') }}</td>
                    <td>
                        @if($doctor->rating)
                            <span class="text-warning"><i class="bi bi-star-fill"></i></span> {{ $doctor->rating }}
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.doctors.edit', $doctor) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('admin.doctors.destroy', $doctor) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus dokter ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash3"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="9" class="text-center text-muted py-3">Belum ada data dokter</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
