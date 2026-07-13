<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Consultation;
use App\Models\Doctor;
use App\Models\Article;
use App\Models\User;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $totalMembers  = User::where('role', 'member')->count();
        $totalDoctors  = Doctor::count();
        $totalArticles = Article::count();

        $totalBookings           = Booking::count();
        $ongoingConsultations    = Consultation::where('status', 'ongoing')->count();
        $completedConsultations  = Consultation::where('status', 'closed')->count();

        $recentBookings = Booking::with(['user', 'doctor'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalMembers',
            'totalDoctors',
            'totalArticles',
            'totalBookings',
            'ongoingConsultations',
            'completedConsultations',
            'recentBookings'
        ));
    }
}
