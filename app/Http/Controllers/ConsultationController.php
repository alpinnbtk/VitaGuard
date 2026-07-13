<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'member') {
            $bookings = Booking::with(['doctor', 'consultation'])
                ->where('user_id', $user->id)
                ->latest('booking_date')
                ->paginate(10);

            return view('member.consultations.index', compact('bookings'));
        }

        if ($user->role === 'doctor') {
            $doctor = $user->doctor;

            $consultations = Consultation::with(['booking.user', 'booking.doctor'])
                ->where('status', 'ongoing')
                ->whereHas('booking', fn($q) => $q->where('doctor_id', $doctor->id))
                ->latest()
                ->paginate(10);

            return view('doctor.consultations.index', compact('consultations'));
        }

        $consultations = Consultation::with(['booking.user', 'booking.doctor'])
            ->latest()
            ->paginate(15);

        return view('admin.consultations.index', compact('consultations'));
    }

    public function show(Consultation $consultation)
    {
        $user    = auth()->user();
        $booking = $consultation->booking()->with(['doctor', 'user'])->firstOrFail();

        if ($user->role === 'member' && $booking->user_id !== $user->id) {
            abort(403);
        }
        if ($user->role === 'doctor' && $booking->doctor->user_id !== $user->id) {
            abort(403);
        }

        $messages = $consultation->consultation_messages()
            ->with('sender:id,name,role')
            ->orderBy('sent_at')
            ->get();

        if ($user->role === 'doctor') {
            return view('doctor.consultations.show', compact('consultation', 'booking', 'messages'));
        }

        if ($user->role === 'admin') {
            return view('admin.consultations.show', compact('consultation', 'booking', 'messages'));
        }

        return view('member.consultations.show', compact('consultation', 'booking', 'messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
        ]);

        $user    = auth()->user();
        $booking = Booking::findOrFail($request->booking_id);

        if ($booking->user_id !== $user->id) {
            abort(403);
        }

        if ($booking->status !== 'confirmed') {
            return redirect()->route('member.consultations.index')
                ->with('error', 'Booking harus berstatus "Confirmed" sebelum memulai konsultasi.');
        }

        if ($booking->consultation) {
            return redirect()->route('member.consultations.show', $booking->consultation->id)
                ->with('info', 'Sesi konsultasi sudah ada.');
        }

        $consultation = Consultation::create([
            'booking_id' => $booking->id,
            'status'     => 'ongoing',
            'started_at' => now(),
        ]);

        return redirect()->route('member.consultations.show', $consultation->id)
            ->with('success', 'Sesi konsultasi dimulai!');
    }

    public function update(Request $request, Consultation $consultation)
    {
        $user    = auth()->user();
        $booking = $consultation->booking()->with('doctor')->firstOrFail();

        if ($user->role === 'doctor' && $booking->doctor->user_id !== $user->id) {
            abort(403);
        }

        if ($consultation->status === 'closed') {
            return redirect()->back()->with('error', 'Konsultasi sudah ditutup sebelumnya.');
        }

        $request->validate([
            'summary' => 'nullable|string|max:2000',
        ]);

        $consultation->update([
            'status'   => 'closed',
            'ended_at' => now(),
            'summary'  => $request->summary,
        ]);

        $booking->update(['status' => 'completed']);

        return redirect()->route('doctor.history.index')
            ->with('success', 'Konsultasi berhasil ditutup dan disimpan ke riwayat.');
    }

    public function history()
    {
        $user   = auth()->user();
        $doctor = $user->doctor;

        $consultations = Consultation::with(['booking.user', 'booking.doctor'])
            ->where('status', 'closed')
            ->whereHas('booking', fn($q) => $q->where('doctor_id', $doctor->id))
            ->latest('ended_at')
            ->paginate(10);

        return view('doctor.history.index', compact('consultations'));
    }
}
