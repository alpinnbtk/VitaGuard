@extends('layouts.admin')
@section('title', 'Daftar Artikel')

@section('content')
<div class="card-custom">
    <div class="card-header">
        <h5><i class="bi bi-newspaper me-2"></i>Daftar Artikel</h5>
        <a href="{{ route('admin.articles.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Tambah Artikel
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th width="50">#</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Penulis</th>
                    <th>Dipublikasi</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $i => $article)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>
                        <div class="fw-medium">{{ Str::limit($article->title, 50) }}</div>
                        <small class="text-muted">{{ $article->slug }}</small>
                    </td>
                    <td><span class="badge bg-info bg-opacity-10 text-info badge-status">{{ $article->category->category_name ?? '-' }}</span></td>
                    <td>{{ $article->author->name ?? '-' }}</td>
                    <td>{{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}</td>
                    <td>
                        <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash3"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-3">Belum ada artikel</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
