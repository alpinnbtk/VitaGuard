<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Doctor;
use App\Models\DoctorSchedules;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'member') {
            $bookings = Booking::with(['doctor', 'consultation'])
                ->where('user_id', $user->id)
                ->latest('booking_date')
                ->paginate(10);

            return view('member.booking.index', compact('bookings'));
        }

        if ($user->role === 'doctor') {
            $bookings = Booking::with('user')
                ->where('doctor_id', $user->doctor->id)
                ->latest('booking_date')
                ->paginate(10);

            return view('doctor.bookings.index', compact('bookings'));
        }

        // Admin
        $query = Booking::with(['user', 'doctor']);
        if (request('status')) {
            $query->where('status', request('status'));
        }
        $bookings = $query->latest()->paginate(15);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $user = auth()->user();

        if ($user && $user->role === 'admin') {
            $members = User::where('role', 'member')->orderBy('name', 'asc')->get();
            $doctors = Doctor::orderBy('name', 'asc')->get();
            return view('admin.bookings.create', compact('members', 'doctors'));
        }

        if ($user && $user->role === 'member') {
            $doctors = Doctor::orderBy('name', 'asc')->get();
            return view('member.booking.create', compact('doctors'));
        }

        return abort(403);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        if ($user && $user->role === 'admin') {
            $request->validate([
                'user_id'            => 'required|exists:users,id',
                'doctor_id'          => 'required|exists:doctors,id',
                'doctor_schedule_id' => 'required|exists:doctor_schedules,id',
                'booking_date'       => 'required|date',
                'status'             => 'required|in:pending,confirmed,completed,cancelled',
                'complaint'          => 'nullable|string|max:1000',
            ]);

            $schedule = DoctorSchedules::where('id', $request->doctor_schedule_id)
                ->where('doctor_id', $request->doctor_id)
                ->firstOrFail();

            Booking::create([
                'user_id'            => $request->user_id,
                'doctor_id'          => $request->doctor_id,
                'doctor_schedule_id' => $schedule->id,
                'booking_date'       => $request->booking_date,
                'booking_time'       => $schedule->start_time,
                'complaint'          => $request->complaint,
                'status'             => $request->status,
            ]);

            return redirect()->route('admin.bookings.index')
                ->with('success', 'Booking berhasil dibuat!');
        }

        if ($user && $user->role === 'member') {
            $request->validate([
                'doctor_id'          => 'required|exists:doctors,id',
                'doctor_schedule_id' => 'required|exists:doctor_schedules,id',
                'booking_date'       => 'required|date|after_or_equal:today',
                'complaint'          => 'nullable|string|max:1000',
            ]);

            $schedule = DoctorSchedules::where('id', $request->doctor_schedule_id)
                ->where('doctor_id', $request->doctor_id)
                ->firstOrFail();

            Booking::create([
                'user_id'            => auth()->id(),
                'doctor_id'          => $request->doctor_id,
                'doctor_schedule_id' => $schedule->id,
                'booking_date'       => $request->booking_date,
                'booking_time'       => $schedule->start_time,
                'complaint'          => $request->complaint,
                'status'             => 'pending',
            ]);

            return redirect()->route('member.home')
                ->with('success', 'Booking berhasil disubmit! Tunggu konfirmasi dari dokter.');
        }

        return abort(403);
    }

    public function show($id)
    {
        $booking = Booking::with(['doctor', 'user', 'doctorSchedule', 'consultation'])->findOrFail($id);

        $user = auth()->user();

        // Access control
        if ($user->role === 'member' && $booking->user_id !== $user->id) {
            abort(403);
        }
        if ($user->role === 'doctor' && $booking->doctor->user_id !== $user->id) {
            abort(403);
        }

        if ($user->role === 'admin') {
            return view('admin.bookings.show', compact('booking'));
        }

        if ($user->role === 'doctor') {
            return view('doctor.bookings.show', compact('booking'));
        }

        return view('member.booking.show', compact('booking'));
    }

    public function edit($id)
    {
        $user = auth()->user();

        if ($user && $user->role === 'admin') {
            $booking = Booking::findOrFail($id);
            $members = User::where('role', 'member')->orderBy('name', 'asc')->get();
            $doctors = Doctor::orderBy('name', 'asc')->get();
            return view('admin.bookings.edit', compact('booking', 'members', 'doctors'));
        }

        abort(403);
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();

        if ($user && $user->role === 'admin') {
            $booking = Booking::findOrFail($id);

            $request->validate([
                'user_id'            => 'required|exists:users,id',
                'doctor_id'          => 'required|exists:doctors,id',
                'doctor_schedule_id' => 'required|exists:doctor_schedules,id',
                'booking_date'       => 'required|date',
                'status'             => 'required|in:pending,confirmed,completed,cancelled',
                'complaint'          => 'nullable|string|max:1000',
            ]);

            $schedule = DoctorSchedules::where('id', $request->doctor_schedule_id)
                ->where('doctor_id', $request->doctor_id)
                ->firstOrFail();

            $booking->update([
                'user_id'            => $request->user_id,
                'doctor_id'          => $request->doctor_id,
                'doctor_schedule_id' => $schedule->id,
                'booking_date'       => $request->booking_date,
                'booking_time'       => $schedule->start_time,
                'complaint'          => $request->complaint,
                'status'             => $request->status,
            ]);

            return redirect()->route('admin.bookings.index')
                ->with('success', 'Booking berhasil diperbarui!');
        }

        abort(403);
    }

    public function destroy($id)
    {
        $user = auth()->user();

        if ($user && $user->role === 'admin') {
            $booking = Booking::findOrFail($id);
            $booking->delete();

            return redirect()->route('admin.bookings.index')
                ->with('success', 'Booking berhasil dihapus!');
        }

        abort(403);
    }

    public function confirm(Booking $booking)
    {
        $user = auth()->user();

        if ($user->role === 'doctor' && $booking->doctor->user_id !== $user->id) {
            abort(403);
        }

        if ($booking->status !== 'pending') {
            $label = $user->role === 'doctor'
                ? 'doctor.bookings.index'
                : 'admin.bookings.index';

            return redirect()->route($label)
                ->with('error', 'Hanya booking berstatus Pending yang dapat dikonfirmasi.');
        }

        $booking->update(['status' => 'confirmed']);

        $redirectRoute = $user->role === 'doctor' ? 'doctor.bookings.index' : 'admin.bookings.index';

        return redirect()->route($redirectRoute)
            ->with('success', "Booking pasien {$booking->user->name} berhasil dikonfirmasi.");
    }

    public function cancel(Booking $booking)
    {
        $user = auth()->user();

        if ($user->role === 'doctor' && $booking->doctor->user_id !== $user->id) {
            abort(403);
        }

        if (! in_array($booking->status, ['pending', 'confirmed'])) {
            $label = $user->role === 'doctor'
                ? 'doctor.bookings.index'
                : 'admin.bookings.index';

            return redirect()->route($label)
                ->with('error', 'Booking yang sudah selesai atau sudah dibatalkan tidak dapat dibatalkan lagi.');
        }

        $booking->update(['status' => 'cancelled']);

        $redirectRoute = $user->role === 'doctor' ? 'doctor.bookings.index' : 'admin.bookings.index';

        return redirect()->route($redirectRoute)
            ->with('success', "Booking pasien {$booking->user->name} berhasil dibatalkan.");
    }

    public function getSchedules(Doctor $doctor)
    {
        $daysOrder = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        $schedules = $doctor->doctor_schedules()
            ->get(['id', 'day', 'start_time', 'end_time'])
            ->sortBy(function ($schedule) use ($daysOrder) {
                $pos = array_search($schedule->day, $daysOrder);
                return $pos !== false ? $pos : 999;
            })
            ->values();

        return response()->json($schedules);
    }
}
