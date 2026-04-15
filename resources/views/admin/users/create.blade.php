@extends('layouts.admin')
@section('title', 'Tambah User')

@section('content')
<div class="card-custom" style="max-width: 600px;">
    <div class="card-header">
        <h5><i class="bi bi-plus-circle me-2"></i>Tambah User Baru</h5>
    </div>
    <div class="p-4">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label fw-medium">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="username" class="form-label fw-medium">Username <span class="text-danger">*</span></label>
                <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required>
                @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fw-medium">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label fw-medium">No. Telepon</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}">
                @error('phone_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="role" class="form-label fw-medium">Role <span class="text-danger">*</span></label>
                <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required>
                    <option value="member" {{ old('role') == 'member' ? 'selected' : '' }}>Member</option>
                    <option value="doctor" {{ old('role') == 'doctor' ? 'selected' : '' }}>Doctor</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label fw-medium">Password <span class="text-danger">*</span></label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label fw-medium">Konfirmasi Password <span class="text-danger">*</span></label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
