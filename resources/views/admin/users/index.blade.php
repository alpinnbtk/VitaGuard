@extends('layouts.admin')
@section('title', 'Daftar Users')

@section('content')
<div class="card-custom">
    <div class="card-header">
        <h5><i class="bi bi-people-fill me-2"></i>Daftar Users</h5>
        <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Tambah User
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th width="50">#</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Role</th>
                    <th>Verified</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $i => $user)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td class="fw-medium">{{ $user->name }}</td>
                    <td><code>{{ $user->username }}</code></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone_number ?? '-' }}</td>
                    <td>
                        @switch($user->role)
                            @case('admin')
                                <span class="badge bg-danger badge-status">Admin</span>
                                @break
                            @case('doctor')
                                <span class="badge bg-success badge-status">Doctor</span>
                                @break
                            @default
                                <span class="badge bg-secondary badge-status">Member</span>
                        @endswitch
                    </td>
                    <td>
                        @if($user->email_verified_at)
                            <span class="text-success"><i class="bi bi-check-circle-fill"></i></span>
                        @else
                            <span class="text-muted"><i class="bi bi-x-circle"></i></span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash3"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center text-muted py-3">Belum ada user</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
