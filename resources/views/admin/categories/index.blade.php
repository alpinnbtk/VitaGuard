@extends('layouts.admin')
@section('title', 'Kategori Artikel')

@section('content')
<div class="card-custom">
    <div class="card-header">
        <h5><i class="bi bi-tag-fill me-2"></i>Daftar Kategori</h5>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Tambah Kategori
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th width="50">#</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Artikel</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $i => $category)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td class="fw-medium">{{ $category->category_name }}</td>
                    <td>{{ Str::limit($category->description, 60) ?? '-' }}</td>
                    <td><span class="badge bg-info badge-status">{{ $category->articles_count }}</span></td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash3"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-3">Belum ada kategori</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
