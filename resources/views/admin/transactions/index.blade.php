@extends('layouts.admin')
@section('title', 'Daftar Konsultasi')

@section('content')
<div class="card-custom">
    <div class="card-header">
        <h5><i class="bi bi-receipt-cutoff me-2"></i>Daftar Konsultasi</h5>
        <a href="{{ route('admin.transactions.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Tambah Konsultasi
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th width="50">#</th>
                    <th>Member</th>
                    <th>Dokter</th>
                    <th>Tanggal Konsultasi</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Catatan</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $i => $t)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td class="fw-medium">{{ $t->user->name ?? '-' }}</td>
                    <td>{{ $t->doctor->name ?? '-' }}</td>
                    <td>{{ $t->consultation_date->format('d M Y, H:i') }}</td>
                    <td>Rp {{ number_format($t->total_price, 0, ',', '.') }}</td>
                    <td>
                        @switch($t->status)
                            @case('completed')
                                <span class="badge bg-success badge-status">Selesai</span>
                                @break
                            @case('confirmed')
                                <span class="badge bg-primary badge-status">Dikonfirmasi</span>
                                @break
                            @case('pending')
                                <span class="badge bg-warning text-dark badge-status">Menunggu</span>
                                @break
                            @case('cancelled')
                                <span class="badge bg-danger badge-status">Dibatalkan</span>
                                @break
                        @endswitch
                    </td>
                    <td>{{ Str::limit($t->notes, 30) ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.transactions.edit', $t) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('admin.transactions.destroy', $t) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash3"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center text-muted py-3">Belum ada data konsultasi</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
