<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    // =========================================================
    //  INDEX — List consultations
    // =========================================================

    /**
     * Member : list their bookings (used as consultation history overview).
     * Doctor : list their ONGOING consultations (live chat inbox).
     * Admin  : list ALL consultations.
     */
    public function index()
    {
        $user = auth()->user();

        // ------- MEMBER -------
        if ($user->role === 'member') {
            $bookings = Booking::with(['doctor', 'consultation'])
                ->where('user_id', $user->id)
                ->latest('booking_date')
                ->paginate(10);

            return view('member.consultations.index', compact('bookings'));
        }

        // ------- DOCTOR -------
        if ($user->role === 'doctor') {
            $doctor = $user->doctor;

            // Only ONGOING consultations needing attention
            $consultations = Consultation::with(['booking.user', 'booking.doctor'])
                ->where('status', 'ongoing')
                ->whereHas('booking', fn($q) => $q->where('doctor_id', $doctor->id))
                ->latest()
                ->paginate(10);

            return view('doctor.consultations.index', compact('consultations'));
        }

        // ------- ADMIN -------
        $consultations = Consultation::with(['booking.user', 'booking.doctor'])
            ->latest()
            ->paginate(15);

        return view('admin.consultations.index', compact('consultations'));
    }

    // =========================================================
    //  SHOW — View a single consultation / chat room
    // =========================================================

    /**
     * Member : enter the chat room for an ongoing consultation,
     *          or view the read-only history for a closed one.
     * Doctor : enter the chat room for an ongoing consultation (same view logic).
     */
    public function show(Consultation $consultation)
    {
        $user    = auth()->user();
        $booking = $consultation->booking()->with(['doctor', 'user'])->firstOrFail();

        // --- Access control ---
        if ($user->role === 'member' && $booking->user_id !== $user->id) {
            abort(403);
        }
        if ($user->role === 'doctor' && $booking->doctor->user_id !== $user->id) {
            abort(403);
        }

        // Pre-load messages for initial render (JS will keep polling)
        $messages = $consultation->consultation_messages()
            ->with('sender:id,name,role')
            ->orderBy('sent_at')
            ->get();

        if ($user->role === 'doctor') {
            return view('doctor.consultations.show', compact('consultation', 'booking', 'messages'));
        }

        // Member sees the same show view (handles both ongoing & closed states)
        return view('member.consultations.show', compact('consultation', 'booking', 'messages'));
    }

    // =========================================================
    //  STORE — Member starts a new consultation session
    // =========================================================

    /**
     * A member starts a consultation from a CONFIRMED booking.
     * Creates a Consultation record with status = 'ongoing'.
     */
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
        ]);

        $user    = auth()->user();
        $booking = Booking::findOrFail($request->booking_id);

        // Guard: the booking must belong to the current member
        if ($booking->user_id !== $user->id) {
            abort(403);
        }

        // Guard: booking must be confirmed before starting consultation
        if ($booking->status !== 'confirmed') {
            return redirect()->route('member.consultations.index')
                ->with('error', 'Booking harus berstatus "Confirmed" sebelum memulai konsultasi.');
        }

        // Guard: prevent duplicate consultation session
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

    // =========================================================
    //  UPDATE — Doctor closes a consultation session
    // =========================================================

    /**
     * Doctor submits a summary and closes the consultation session.
     * Sets status = 'closed', ended_at = now(), saves optional summary.
     */
    public function update(Request $request, Consultation $consultation)
    {
        $user    = auth()->user();
        $booking = $consultation->booking()->with('doctor')->firstOrFail();

        // Guard: only the treating doctor can close the consultation
        if ($user->role === 'doctor' && $booking->doctor->user_id !== $user->id) {
            abort(403);
        }

        // Guard: cannot close an already-closed consultation
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

        // Also mark the related booking as completed
        $booking->update(['status' => 'completed']);

        return redirect()->route('doctor.history.index')
            ->with('success', 'Konsultasi berhasil ditutup dan disimpan ke riwayat.');
    }

    // =========================================================
    //  HISTORY — Doctor views past (closed) consultations
    // =========================================================

    /**
     * Doctor : list all CLOSED consultations they have handled.
     * Grouped by most recent first, paginated.
     */
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
