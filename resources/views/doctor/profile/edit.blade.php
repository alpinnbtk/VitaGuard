@extends('layouts.doctor')
@section('title', 'Edit Profil')

@section('content')
<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('doctor.profile.show') }}" class="btn btn-sm btn-light" style="border-radius:8px;">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h5 class="fw-semibold mb-0" style="color:#0f172a;">Edit Profil</h5>
        <p class="text-muted mb-0" style="font-size:0.8rem;">Perbarui informasi profil Anda.</p>
    </div>
</div>

<div class="card-custom p-4">
    <form action="{{ route('doctor.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Section: Informasi Akun --}}
        <h6 class="fw-semibold mb-3 pb-2 border-bottom" style="color:#0f172a;">Informasi Akun</h6>
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label class="form-label fw-semibold" style="font-size:0.875rem;">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="form-control @error('name') is-invalid @enderror" style="border-radius:8px;" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold" style="font-size:0.875rem;">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                       class="form-control @error('email') is-invalid @enderror" style="border-radius:8px;" required>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold" style="font-size:0.875rem;">No. Telepon</label>
                <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}"
                       class="form-control @error('phone_number') is-invalid @enderror" style="border-radius:8px;"
                       placeholder="+62 8xx-xxxx-xxxx">
                @error('phone_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- Section: Informasi Praktik --}}
        <h6 class="fw-semibold mb-3 pb-2 border-bottom" style="color:#0f172a;">Informasi Praktik</h6>
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label class="form-label fw-semibold" style="font-size:0.875rem;">Spesialisasi <span class="text-danger">*</span></label>
                <input type="text" name="specialization" value="{{ old('specialization', $doctor->specialization) }}"
                       class="form-control @error('specialization') is-invalid @enderror" style="border-radius:8px;" required>
                @error('specialization') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold" style="font-size:0.875rem;">Pengalaman (Tahun) <span class="text-danger">*</span></label>
                <input type="number" name="experience_years" value="{{ old('experience_years', $doctor->experience_years) }}"
                       class="form-control @error('experience_years') is-invalid @enderror" style="border-radius:8px;" min="0" required>
                @error('experience_years') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-12">
                <label class="form-label fw-semibold" style="font-size:0.875rem;">Alamat Praktik</label>
                <input type="text" name="address" value="{{ old('address', $doctor->address) }}"
                       class="form-control @error('address') is-invalid @enderror" style="border-radius:8px;"
                       placeholder="Jl. Contoh No. 1, Kota...">
                @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-12">
                <label class="form-label fw-semibold" style="font-size:0.875rem;">Bio / Deskripsi Singkat</label>
                <textarea name="bio" rows="4"
                          class="form-control @error('bio') is-invalid @enderror"
                          style="border-radius:8px; font-size:0.875rem;"
                          placeholder="Ceritakan tentang keahlian dan pengalaman Anda...">{{ old('bio', $doctor->bio) }}</textarea>
                @error('bio') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- Section: Foto Profil --}}
        <h6 class="fw-semibold mb-3 pb-2 border-bottom" style="color:#0f172a;">Foto Profil</h6>
        <div class="row g-3 mb-4 align-items-center">
            <div class="col-auto">
                @if($doctor->image)
                    <img src="{{ asset('storage/' . $doctor->image) }}" id="preview-img"
                         class="rounded-circle" style="width:70px; height:70px; object-fit:cover; border:2px solid var(--accent);">
                @else
                    <div id="preview-placeholder" class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center"
                         style="width:70px; height:70px; font-size:1.8rem;">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <img id="preview-img" src="#" class="rounded-circle d-none"
                         style="width:70px; height:70px; object-fit:cover; border:2px solid var(--accent);">
                @endif
            </div>
            <div class="col">
                <label class="form-label fw-semibold" style="font-size:0.875rem;">Ganti Foto</label>
                <input type="file" name="image" id="image-input" accept="image/*"
                       class="form-control @error('image') is-invalid @enderror" style="border-radius:8px;"
                       onchange="previewImage(event)">
                <small class="text-muted">Format: JPG, PNG, WEBP. Maks. 2MB.</small>
                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('doctor.profile.show') }}" class="btn btn-light" style="border-radius:8px;">Batal</a>
            <button type="submit" class="btn btn-primary" style="border-radius:8px;">
                <i class="bi bi-floppy-fill me-1"></i>Simpan Perubahan
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
function previewImage(event) {
    const file    = event.target.files[0];
    const preview = document.getElementById('preview-img');
    const placeholder = document.getElementById('preview-placeholder');

    if (file) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
            if (placeholder) placeholder.classList.add('d-none');
        };
        reader.readAsDataURL(file);
    }
}
</script>
@endpush
@endsection
