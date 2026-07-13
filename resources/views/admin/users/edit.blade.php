@extends('layouts.admin')
@section('title', 'Edit User')

@section('content')
<div class="card-custom" style="max-width: 600px;">
    <div class="card-header">
        <h5><i class="bi bi-pencil-square me-2"></i>Edit User</h5>
    </div>
    <div class="p-4">
        <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-3">
                <label for="photo" class="form-label fw-medium">Foto Profil</label>

                @if($user->photo)
                    <div class="mb-2">
                        <img src="{{ asset($user->photo) }}"
                            alt="Foto {{ $user->name }}"
                            class="rounded-circle"
                            style="width:64px; height:64px; object-fit:cover; border:2px solid #0ea5e9;">
                        <small class="text-muted ms-2">Foto saat ini</small>
                    </div>
                @else
                    <div class="mb-2 d-flex align-items-center gap-2">
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center"
                            style="width:64px; height:64px; font-size:1.5rem;">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <small class="text-muted">Belum ada foto</small>
                    </div>
                @endif

                <input type="file"
                    name="photo"
                    id="photo"
                    class="form-control @error('photo') is-invalid @enderror"
                    accept="image/jpeg,image/png,image/jpg,image/webp">
                <div class="form-text">Format: JPG, PNG, WEBP. Maks. 2MB. Kosongkan jika tidak ingin mengubah foto.</div>
                @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label fw-medium">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="username" class="form-label fw-medium">Username <span class="text-danger">*</span></label>
                <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $user->username) }}" required>
                @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fw-medium">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label fw-medium">No. Telepon</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number', $user->phone_number) }}">
                @error('phone_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="role" class="form-label fw-medium">Role <span class="text-danger">*</span></label>
                <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required>
                    <option value="member" {{ old('role', $user->role) == 'member' ? 'selected' : '' }}>Member</option>
                    <option value="doctor" {{ old('role', $user->role) == 'doctor' ? 'selected' : '' }}>Doctor</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label fw-medium">Password <small class="text-muted">(kosongkan jika tidak ingin mengubah)</small></label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label fw-medium">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Perbarui</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
