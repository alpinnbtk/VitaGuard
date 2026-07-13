<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorSchedules;
use Illuminate\Http\Request;

class DoctorScheduleController extends Controller
{
    public function index()
    {
        $schedules = DoctorSchedules::with('doctor')
            ->orderByRaw("FIELD(day, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu')")
            ->paginate(15);

        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        $doctors = Doctor::orderBy('name', 'asc')->get();
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        return view('admin.schedules.create', compact('doctors', 'days'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'day' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        DoctorSchedules::create($request->only(['doctor_id', 'day', 'start_time', 'end_time']));

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Jadwal dokter berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $schedule = DoctorSchedules::findOrFail($id);
        $doctors = Doctor::orderBy('name', 'asc')->get();
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        return view('admin.schedules.edit', compact('schedule', 'doctors', 'days'));
    }

    public function update(Request $request, $id)
    {
        $schedule = DoctorSchedules::findOrFail($id);

        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'day' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $schedule->update($request->only(['doctor_id', 'day', 'start_time', 'end_time']));

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Jadwal dokter berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $schedule = DoctorSchedules::findOrFail($id);
        $schedule->delete();

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Jadwal dokter berhasil dihapus!');
    }
}
