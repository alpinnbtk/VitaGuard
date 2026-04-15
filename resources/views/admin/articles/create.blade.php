@extends('layouts.admin')
@section('title', 'Tambah Artikel')

@section('content')
<div class="card-custom" style="max-width: 800px;">
    <div class="card-header">
        <h5><i class="bi bi-plus-circle me-2"></i>Tambah Artikel Baru</h5>
    </div>
    <div class="p-4">
        <form action="{{ route('admin.articles.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label fw-medium">Judul Artikel <span class="text-danger">*</span></label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label for="category_id" class="form-label fw-medium">Kategori <span class="text-danger">*</span></label>
                    <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="author_id" class="form-label fw-medium">Penulis <span class="text-danger">*</span></label>
                    <select name="author_id" id="author_id" class="form-select @error('author_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Penulis --</option>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                        @endforeach
                    </select>
                    @error('author_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label fw-medium">Konten <span class="text-danger">*</span></label>
                <textarea name="content" id="content" rows="8" class="form-control @error('content') is-invalid @enderror" required>{{ old('content') }}</textarea>
                @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="published_at" class="form-label fw-medium">Tanggal Publikasi</label>
                <input type="datetime-local" name="published_at" id="published_at" class="form-control @error('published_at') is-invalid @enderror" value="{{ old('published_at') }}">
                <small class="text-muted">Kosongkan untuk mempublikasi sekarang</small>
                @error('published_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan</button>
                <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
