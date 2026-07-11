@extends('layouts.admin')
@section('title', 'Manajemen Konsultasi')

@section('content')
<div class="card-custom">
    <div class="card-header">
        <h5><i class="bi bi-calendar-check me-2"></i>Daftar Konsultasi</h5>
        <div class="d-flex gap-3 align-items-center">
            {{-- Status filter --}}
            <form method="GET" class="d-flex gap-2 m-0">
                <select name="status" class="form-select form-select-sm" style="border-radius:8px; width:auto;"
                        onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="pending"   {{ request('status') === 'pending'    ? 'selected' : '' }}>Menunggu</option>
                    <option value="confirmed" {{ request('status') === 'confirmed'  ? 'selected' : '' }}>Dikonfirmasi</option>
                    <option value="completed" {{ request('status') === 'completed'  ? 'selected' : '' }}>Selesai</option>
                    <option value="cancelled" {{ request('status') === 'cancelled'  ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </form>
            <a href="{{ route('admin.bookings.create') }}" class="btn btn-sm btn-primary" style="border-radius:8px;">
                <i class="bi bi-plus-lg me-1"></i>Tambah Konsultasi
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Member</th>
                    <th>Dokter</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Status</th>
                    <th class="text-center" width="220">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                <tr>
                    <td>
                        <div class="fw-semibold" style="font-size:0.875rem; color:#0f172a;">
                            {{ $booking->user->name ?? '-' }}
                        </div>
                        <small class="text-muted">{{ $booking->user->email ?? '' }}</small>
                    </td>
                    <td>
                        <div style="font-size:0.875rem;">{{ $booking->doctor->name ?? '-' }}</div>
                        <small class="text-muted">{{ $booking->doctor->specialization ?? '' }}</small>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}</td>
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
                        <div class="d-flex gap-2 justify-content-center align-items-center">
                            @if($booking->status === 'pending')
                                <form action="{{ route('admin.bookings.confirm', $booking->id) }}" method="POST"
                                      onsubmit="return confirm('Konfirmasi booking ini?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-success" style="border-radius:8px; font-size:0.75rem; padding: 4px 8px;">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </button>
                                </form>

                                <form action="{{ route('admin.bookings.cancel', $booking->id) }}" method="POST"
                                      onsubmit="return confirm('Batalkan booking ini?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius:8px; font-size:0.75rem; padding: 4px 8px;">
                                        <i class="bi bi-x-circle-fill"></i>
                                    </button>
                                </form>
                            @endif

                            {{-- Edit --}}
                            <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-sm btn-outline-warning"
                               style="border-radius:8px; font-size:0.75rem; padding: 4px 8px;">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            {{-- Delete --}}
                            <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus data konsultasi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                        style="border-radius:8px; font-size:0.75rem; padding: 4px 8px;">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Tidak ada data konsultasi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $bookings->links() }}
</div>
@endsection
