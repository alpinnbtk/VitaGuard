<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('user')->latest()->get();
        return view('admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        $users = User::where('role', 'doctor')->doesntHave('doctor')->get();
        return view('admin.doctors.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email',
            'phone_number' => 'required|string|max:20',
            'gender' => 'required|in:male,female',
            'address' => 'nullable|string',
            'experience_years' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'user_id' => 'nullable|exists:users,id',
        ]);

        Doctor::create($request->only([
            'user_id', 'name', 'specialization', 'email', 'phone_number',
            'gender', 'address', 'experience_years', 'price', 'rating'
        ]));

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Dokter berhasil ditambahkan!');
    }

    public function show(Doctor $doctor)
    {
        $doctor->load(['user', 'transactions.user']);
        return view('admin.doctors.show', compact('doctor'));
    }

    public function edit(Doctor $doctor)
    {
        $users = User::where('role', 'doctor')
            ->where(function ($q) use ($doctor) {
                $q->doesntHave('doctor')
                  ->orWhere('id', $doctor->user_id);
            })->get();
        return view('admin.doctors.edit', compact('doctor', 'users'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email,' . $doctor->id,
            'phone_number' => 'required|string|max:20',
            'gender' => 'required|in:male,female',
            'address' => 'nullable|string',
            'experience_years' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $doctor->update($request->only([
            'user_id', 'name', 'specialization', 'email', 'phone_number',
            'gender', 'address', 'experience_years', 'price', 'rating'
        ]));

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Data dokter berhasil diperbarui!');
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return redirect()->route('admin.doctors.index')
            ->with('success', 'Dokter berhasil dihapus!');
    }
}
