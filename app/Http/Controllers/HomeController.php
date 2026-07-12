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

        $totalBookings         = $doctor->bookings()->count();
        $activeConsultations   = $doctor->consultations()->where('consultations.status', 'ongoing')->count();
        $completedConsultations = $doctor->consultations()->where('consultations.status', 'closed')->count();
        $recentBookings        = $doctor->bookings()->with('user')->latest()->take(5)->get();

        return view('doctor.home', compact(
            'totalBookings',
            'activeConsultations',
            'completedConsultations',
            'recentBookings'
        ));
    }
}
