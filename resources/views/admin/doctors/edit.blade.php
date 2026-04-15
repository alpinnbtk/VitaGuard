@extends('layouts.admin')
@section('title', 'Edit Dokter')

@section('content')
<div class="card-custom" style="max-width: 700px;">
    <div class="card-header">
        <h5><i class="bi bi-pencil-square me-2"></i>Edit Dokter</h5>
    </div>
    <div class="p-4">
        <form action="{{ route('admin.doctors.update', $doctor) }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="name" class="form-label fw-medium">Nama Dokter <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $doctor->name) }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="specialization" class="form-label fw-medium">Spesialisasi <span class="text-danger">*</span></label>
                    <input type="text" name="specialization" id="specialization" class="form-control @error('specialization') is-invalid @enderror" value="{{ old('specialization', $doctor->specialization) }}" required>
                    @error('specialization') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label fw-medium">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $doctor->email) }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="phone_number" class="form-label fw-medium">No. Telepon <span class="text-danger">*</span></label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number', $doctor->phone_number) }}" required>
                    @error('phone_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="gender" class="form-label fw-medium">Jenis Kelamin <span class="text-danger">*</span></label>
                    <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror" required>
                        <option value="male" {{ old('gender', $doctor->gender) == 'male' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="female" {{ old('gender', $doctor->gender) == 'female' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="experience_years" class="form-label fw-medium">Pengalaman (tahun) <span class="text-danger">*</span></label>
                    <input type="number" name="experience_years" id="experience_years" class="form-control @error('experience_years') is-invalid @enderror" value="{{ old('experience_years', $doctor->experience_years) }}" min="0" required>
                    @error('experience_years') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="price" class="form-label fw-medium">Harga Konsultasi (Rp) <span class="text-danger">*</span></label>
                    <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $doctor->price) }}" step="1000" min="0" required>
                    @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="rating" class="form-label fw-medium">Rating</label>
                    <input type="number" name="rating" id="rating" class="form-control @error('rating') is-invalid @enderror" value="{{ old('rating', $doctor->rating) }}" step="0.01" min="0" max="5">
                    @error('rating') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="user_id" class="form-label fw-medium">Akun User (Opsional)</label>
                    <select name="user_id" id="user_id" class="form-select">
                        <option value="">-- Tidak dikaitkan --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $doctor->user_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->username }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label for="address" class="form-label fw-medium">Alamat</label>
                    <textarea name="address" id="address" rows="2" class="form-control @error('address') is-invalid @enderror">{{ old('address', $doctor->address) }}</textarea>
                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Perbarui</button>
                <a href="{{ route('admin.doctors.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
