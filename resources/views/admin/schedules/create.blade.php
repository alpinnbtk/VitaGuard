@extends('layouts.admin')
@section('title', 'Tambah Jadwal Dokter')

@section('content')
<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('admin.schedules.index') }}" class="btn btn-sm btn-light" style="border-radius:8px;">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h5 class="fw-semibold mb-0" style="color:#0f172a;">Tambah Jadwal Praktik</h5>
        <p class="text-muted mb-0" style="font-size:0.8rem;">Daftarkan hari dan jam praktik dokter baru.</p>
    </div>
</div>

<div class="card-custom p-4">
    <form action="{{ route('admin.schedules.store') }}" method="POST">
        @csrf

        <div class="row g-3 mb-4">
            {{-- Doctor --}}
            <div class="col-md-6">
                <label for="doctor_id" class="form-label fw-semibold" style="font-size:0.875rem;">Dokter <span class="text-danger">*</span></label>
                <select name="doctor_id" id="doctor_id" class="form-select @error('doctor_id') is-invalid @enderror" style="border-radius:8px;" required>
                    <option value="">-- Pilih Dokter --</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                            {{ $doctor->name }} ({{ $doctor->specialization }})
                        </option>
                    @endforeach
                </select>
                @error('doctor_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Day --}}
            <div class="col-md-6">
                <label for="day" class="form-label fw-semibold" style="font-size:0.875rem;">Hari Praktik <span class="text-danger">*</span></label>
                <select name="day" id="day" class="form-select @error('day') is-invalid @enderror" style="border-radius:8px;" required>
                    <option value="">-- Pilih Hari --</option>
                    @foreach($days as $day)
                        <option value="{{ $day }}" {{ old('day') === $day ? 'selected' : '' }}>
                            {{ $day }}
                        </option>
                    @endforeach
                </select>
                @error('day') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Start Time --}}
            <div class="col-md-6">
                <label for="start_time" class="form-label fw-semibold" style="font-size:0.875rem;">Jam Mulai <span class="text-danger">*</span></label>
                <input type="time" name="start_time" id="start_time" class="form-control @error('start_time') is-invalid @enderror"
                       style="border-radius:8px;" value="{{ old('start_time') }}" required>
                @error('start_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- End Time --}}
            <div class="col-md-6">
                <label for="end_time" class="form-label fw-semibold" style="font-size:0.875rem;">Jam Selesai <span class="text-danger">*</span></label>
                <input type="time" name="end_time" id="end_time" class="form-control @error('end_time') is-invalid @enderror"
                       style="border-radius:8px;" value="{{ old('end_time') }}" required>
                @error('end_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('admin.schedules.index') }}" class="btn btn-light" style="border-radius:8px;">Batal</a>
            <button type="submit" class="btn btn-primary" style="border-radius:8px;">
                <i class="bi bi-floppy-fill me-1"></i>Simpan Jadwal
            </button>
        </div>
    </form>
</div>
@endsection
