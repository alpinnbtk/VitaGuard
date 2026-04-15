<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Article;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMembers = User::where('role', 'member')->count();
        $totalDoctors = Doctor::count();
        $totalArticles = Article::count();
        $totalTransactions = Transaction::count();
        $recentTransactions = Transaction::with(['user', 'doctor'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalMembers',
            'totalDoctors',
            'totalArticles',
            'totalTransactions',
            'recentTransactions'
        ));
    }
}
