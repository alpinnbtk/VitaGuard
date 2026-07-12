@extends('layouts.member')

@section('content')
<div class="container mt-5 mb-5">
    <a href="{{ route('member.articles.index') }}" class="btn btn-outline-secondary mb-4" style="border-radius:20px;">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Artikel
    </a>

    <div class="card shadow-sm" style="border-radius: 15px; border: none; overflow: hidden;">
        <img src="{{ $article->image ?? asset('images/articles/default-article.jpg') }}" class="card-img-top" alt="{{ $article->title }}" style="height: 400px; object-fit: cover;">
        
        <div class="card-body p-4 p-md-5">
            <h1 style="font-family: 'Sora', sans-serif; color: var(--dark); font-weight: 700; margin-bottom:1rem;">
                {{ $article->title }}
            </h1>
            
            <div class="d-flex align-items-center mb-4 text-muted" style="font-size: 0.9rem;">
                <div class="me-4"><i class="bi bi-person-circle me-1"></i> {{ $article->author->name ?? 'Admin' }}</div>
                <div class="me-4"><i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($article->published_at)->format('d M Y') }}</div>
                <div><i class="bi bi-tag me-1"></i> {{ $article->category->name ?? 'Umum' }}</div>
            </div>

            <hr>

            <div class="article-content mt-4" style="line-height: 1.8; color: #4a5568;">
                {!! nl2br(e($article->content)) !!}
            </div>
        </div>
    </div>
</div>
@endsection
