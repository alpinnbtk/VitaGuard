@extends('layouts.member')

@section('content')
<div class="container mt-5">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 style="font-family: 'Sora', sans-serif; color: var(--dark); font-weight: 700;">Read Our Latest Articles</h2>
            <hr style="width: 50px; height: 3px; background-color: var(--dark); opacity: 1; border: none;">
        </div>
        
        <form action="{{ route('member.articles.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari judul artikel..." value="{{ request('search') }}" style="border-radius: 20px;">
            <button type="submit" class="btn text-white" style="background-color: var(--accent); border-radius: 20px; padding: 8px 20px;">Cari</button>
        </form>
    </div>

    <div class="row">
        @forelse ($articles as $article)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm" style="border-radius: 15px; border: none; overflow: hidden;">
                    <img src="{{ $article->image ?? asset('images/articles/default-article.jpg') }}" class="card-img-top" alt="{{ $article->title }}" style="height: 220px; object-fit: cover;">
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title" style="font-weight: 600; color: var(--dark);">{{ $article->title }}</h5>
                        
                        <p class="card-text text-muted" style="font-size: 0.9rem;">
                            {{ Str::limit(strip_tags($article->content), 100) }}
                        </p>
                        
                        <a href="{{ route('member.articles.show', $article->id) }}" class="btn mt-auto w-100 text-white" style="background-color: var(--accent-dark); border-radius: 10px; font-weight: 500;">Learn More</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p>Artikel tidak ditemukan.</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $articles->links() }}
    </div>
</div>
@endsection
