@extends('layouts.admin')
@section('title', 'Manajemen Jadwal Dokter')
@section('content')
<div class="card-custom">
    <div class="card-header">
        <h5><i class="bi bi-calendar-range-fill me-2"></i>Jadwal Praktik Dokter</h5>
        <a href="{{ route('admin.schedules.create') }}" class="btn btn-sm btn-primary" style="border-radius:8px;">
            <i class="bi bi-plus-lg me-1"></i>Tambah Jadwal
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th width="80">#</th>
                    <th>Dokter</th>
                    <th>Spesialisasi</th>
                    <th>Hari Praktik</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
                    <th class="text-center" width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($schedules as $index => $schedule)
                <tr>
                    <td>{{ $schedules->firstItem() + $index }}</td>
                    <td class="fw-semibold" style="color:#0f172a;">{{ $schedule->doctor->name ?? '—' }}</td>
                    <td>{{ $schedule->doctor->specialization ?? '—' }}</td>
                    <td>
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-1" style="border-radius:8px;">
                            {{ $schedule->day }}
                        </span>
                    </td>
                    <td class="fw-medium text-success">{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}</td>
                    <td class="fw-medium text-danger">{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</td>
                    <td class="text-center">
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="{{ route('admin.schedules.edit', $schedule->id) }}" class="btn btn-sm btn-outline-warning" style="border-radius:8px;">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')" class="m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius:8px;">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">Belum ada jadwal praktik dokter yang terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $schedules->links() }}
</div>
@endsection
