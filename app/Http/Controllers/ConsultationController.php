<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class ConsultationController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->role === 'member') {
            $bookings = \App\Models\Booking::with('doctor')
                ->where('user_id', auth()->id())
                ->latest('booking_date')
                ->paginate(10);
            return view('member.consultations.index', compact('bookings'));
        }
        
        return abort(403);
    }
}
