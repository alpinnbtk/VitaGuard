@extends('layouts.admin')
@section('title', 'Tambah Kategori')

@section('content')
<div class="card-custom" style="max-width: 600px;">
    <div class="card-header">
        <h5><i class="bi bi-plus-circle me-2"></i>Tambah Kategori Baru</h5>
    </div>
    <div class="p-4">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="category_name" class="form-label fw-medium">Nama Kategori <span class="text-danger">*</span></label>
                <input type="text" name="category_name" id="category_name" class="form-control @error('category_name') is-invalid @enderror" value="{{ old('category_name') }}" required>
                @error('category_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label fw-medium">Deskripsi</label>
                <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
