<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function memberHome()
    {
        return view('member.home');
    }

    public function doctorHome()
    {
        $doctor = Auth::user()->doctor;

        $totalBookings         = $doctor ? $doctor->bookings()->count() : 0;
        $activeConsultations   = $doctor ? $doctor->consultations()->where('consultations.status', 'ongoing')->count() : 0;
        $completedConsultations = $doctor ? $doctor->consultations()->where('consultations.status', 'closed')->count() : 0;
        $recentBookings        = $doctor ? $doctor->bookings()->with('user')->latest()->take(5)->get() : collect();

        return view('doctor.home', compact(
            'totalBookings',
            'activeConsultations',
            'completedConsultations',
            'recentBookings'
        ));
    }
}
