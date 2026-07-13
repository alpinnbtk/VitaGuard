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

        $bookingStatusData = [
            'pending'   => Booking::where('status', 'pending')->count(),
            'confirmed' => Booking::where('status', 'confirmed')->count(),
            'completed' => Booking::where('status', 'completed')->count(),
            'cancelled' => Booking::where('status', 'cancelled')->count(),
        ];

        $monthlyBookings = Booking::selectRaw("
                DATE_FORMAT(booking_date, '%b %Y') as month,
                DATE_FORMAT(booking_date, '%Y%m')  as sort_key,
                COUNT(*) as total
            ")
            ->where('booking_date', '>=', now()->subMonths(5)->startOfMonth())
            ->groupByRaw("DATE_FORMAT(booking_date, '%b %Y'), DATE_FORMAT(booking_date, '%Y%m')")
            ->orderBy('sort_key')
            ->get();

        return view('admin.dashboard', compact(
            'totalMembers',
            'totalDoctors',
            'totalArticles',
            'totalBookings',
            'ongoingConsultations',
            'completedConsultations',
            'recentBookings',
            'bookingStatusData',
            'monthlyBookings'
        ));
    }
}
