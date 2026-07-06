<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ...
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->check() && auth()->user()->role === 'member') {
            $doctors = \App\Models\Doctor::orderBy('name', 'asc')->get();
            return view('member.booking.create', compact('doctors'));
        }
        return abort(403);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
            'complaint' => 'nullable|string'
        ]);

        \App\Models\Booking::create([
            'user_id' => auth()->id(),
            'doctor_id' => $request->doctor_id,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'complaint' => $request->complaint,
            'status' => 'pending',
            'doctor_schedule_id' => null
        ]);

        return redirect()->route('member.home')->with('success', 'Booking berhasil disubmit!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // ...
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // ...
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // ...
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // ...
    }
}
