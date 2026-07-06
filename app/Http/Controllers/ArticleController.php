<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->check() && auth()->user()->role === 'member') {
            $search = $request->input('search');
            $articles = Article::when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%");
            })->latest('published_at')->paginate(6);
            
            return view('member.articles.index', compact('articles'));
        }

        $articles = Article::with(['author', 'category'])->latest()->get();
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        $authors = User::whereIn('role', ['admin', 'doctor'])->get();
        return view('admin.articles.create', compact('categories', 'authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:users,id',
            'published_at' => 'nullable|date',
        ]);

        Article::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'author_id' => $request->author_id,
            'category_id' => $request->category_id,
            'published_at' => $request->published_at ?? now(),
        ]);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function show(Article $article)
    {
        $article->load(['author', 'category']);
        
        if (auth()->check() && auth()->user()->role === 'member') {
            return view('member.articles.show', compact('article'));
        }
        
        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        $authors = User::whereIn('role', ['admin', 'doctor'])->get();
        return view('admin.articles.edit', compact('article', 'categories', 'authors'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:users,id',
            'published_at' => 'nullable|date',
        ]);

        $article->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'author_id' => $request->author_id,
            'category_id' => $request->category_id,
            'published_at' => $request->published_at ?? $article->published_at,
        ]);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dihapus!');
    }
}
