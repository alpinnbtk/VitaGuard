@extends('layouts.member')

@section('content')
<div class="container mt-5 mb-5">
    <div class="mb-4">
        <h2 style="font-family: 'Sora', sans-serif; color: var(--dark); font-weight: 700;">Edit Profil</h2>
        <hr style="width: 50px; height: 3px; background-color: var(--dark); opacity: 1; border: none;">
        <p class="text-muted">Lengkapi data personal dan kesehatan Anda agar kami dapat memberikan layanan terbaik.</p>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm" style="border-radius: 15px; border: none;">
                <div class="card-body p-4 p-md-5">

                    <form action="{{ route('member.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <h5 class="mb-3" style="color: var(--dark); font-weight: 600;">Foto Profil</h5>
                        <div class="row mb-4 align-items-center">
                            <div class="col-auto">
                                @if($user->photo)
                                    <img src="{{ asset($user->photo) }}" id="preview-img"
                                         class="rounded-circle shadow-sm" style="width:80px; height:80px; object-fit:cover; border:2px solid var(--accent);">
                                @else
                                    <div id="preview-placeholder" class="rounded-circle shadow-sm d-flex align-items-center justify-content-center"
                                         style="width:80px; height:80px; font-size:2rem; background-color: rgba(43, 179, 167, 0.1); color: var(--accent);">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                    <img id="preview-img" src="#" class="rounded-circle shadow-sm d-none"
                                         style="width:80px; height:80px; object-fit:cover; border:2px solid var(--accent);">
                                @endif
                            </div>
                            <div class="col">
                                <label class="form-label" style="font-weight: 500;">Ganti Foto</label>
                                <input type="file" name="photo" id="photo-input" accept="image/*"
                                       class="form-control @error('photo') is-invalid @enderror" style="border-radius: 10px;"
                                       onchange="previewImage(event)">
                                <small class="text-muted">Format: JPG, PNG. Maks. 2MB.</small>
                                @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <hr class="mb-4" style="border-color: #eee;">

                        <h5 class="mb-4" style="color: var(--dark); font-weight: 600;">Informasi Akun</h5>

                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 500;">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required style="border-radius: 10px;">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" style="font-weight: 500;">Username</label>
                                <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required style="border-radius: 10px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" style="font-weight: 500;">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required style="border-radius: 10px;">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label" style="font-weight: 500;">Nomor HP</label>
                            <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}" style="border-radius: 10px;">
                        </div>

                        <hr class="mb-4" style="border-color: #eee;">

                        <h5 class="mb-4" style="color: var(--dark); font-weight: 600;">Informasi Kesehatan & Lainnya</h5>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label" style="font-weight: 500;">Jenis Kelamin</label>
                                <select name="gender" class="form-select" style="border-radius: 10px;">
                                    <option value="">-- Pilih --</option>
                                    <option value="male" {{ old('gender', optional($user->member)->gender) === 'male' ? 'selected' : '' }}>Laki-Laki</option>
                                    <option value="female" {{ old('gender', optional($user->member)->gender) === 'female' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" style="font-weight: 500;">Tanggal Lahir</label>
                                <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', optional($user->member)->date_of_birth) }}" style="border-radius: 10px;">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" style="font-weight: 500;">Golongan Darah</label>
                                <select name="blood_type" class="form-select" style="border-radius: 10px;">
                                    <option value="">-- Pilih --</option>
                                    @foreach(['A', 'B', 'AB', 'O', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $bt)
                                        <option value="{{ $bt }}" {{ old('blood_type', optional($user->member)->blood_type) === $bt ? 'selected' : '' }}>{{ $bt }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label" style="font-weight: 500;">Alamat Lengkap</label>
                            <textarea name="address" class="form-control" rows="3" style="border-radius: 10px;">{{ old('address', optional($user->member)->address) }}</textarea>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('member.profile.show') }}" class="btn btn-light px-4 me-2" style="border-radius: 20px;">Batal</a>
                            <button type="submit" class="btn text-white px-4" style="background-color: var(--accent); border-radius: 20px;">Simpan Perubahan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function previewImage(event) {
    const file = event.target.files[0];
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
