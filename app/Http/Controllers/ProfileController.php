<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // =========================================================
    //  MEMBER PROFILE
    // =========================================================

    public function show()
    {
        if (auth()->check() && auth()->user()->role === 'member') {
            $user = auth()->user()->load('member');
            return view('member.profile.show', compact('user'));
        }

        return abort(403);
    }

    public function edit()
    {
        if (auth()->check() && auth()->user()->role === 'member') {
            $user = auth()->user()->load('member');
            return view('member.profile.edit', compact('user'));
        }

        return abort(403);
    }

    public function update(Request $request)
    {
        if (auth()->check() && auth()->user()->role === 'member') {
            $user = auth()->user();

            $request->validate([
                'name'          => 'required|string|max:255',
                'username'      => 'required|string|max:50|unique:users,username,' . $user->id,
                'email'         => 'required|email|max:255|unique:users,email,' . $user->id,
                'phone_number'  => 'nullable|string|max:20',
                'gender'        => 'nullable|in:male,female',
                'date_of_birth' => 'nullable|date',
                'blood_type'    => 'nullable|string|max:5',
                'address'       => 'nullable|string',
            ]);

            // Update Users Table
            $user->update([
                'name'         => $request->name,
                'username'     => $request->username,
                'email'        => $request->email,
                'phone_number' => $request->phone_number,
            ]);

            // Update or Create Members Table
            $user->member()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'gender'        => $request->gender,
                    'date_of_birth' => $request->date_of_birth,
                    'blood_type'    => $request->blood_type,
                    'address'       => $request->address,
                ]
            );

            return redirect()->route('member.profile.show')
                ->with('success', 'Profil berhasil diperbarui!');
        }

        return abort(403);
    }

    // =========================================================
    //  DOCTOR PROFILE
    // =========================================================

    /**
     * Show the doctor's profile (read-only view).
     */
    public function doctorShow()
    {
        if (auth()->check() && auth()->user()->role === 'doctor') {
            $user   = auth()->user();
            $doctor = $user->doctor;

            if (!$doctor) {
                return redirect()->route('doctor.home')
                    ->with('error', 'Profil dokter belum dibuat oleh administrator.');
            }

            return view('doctor.profile.show', compact('user', 'doctor'));
        }

        return abort(403);
    }

    /**
     * Show the doctor's profile edit form.
     */
    public function doctorEdit()
    {
        if (auth()->check() && auth()->user()->role === 'doctor') {
            $user   = auth()->user();
            $doctor = $user->doctor;

            if (!$doctor) {
                return redirect()->route('doctor.home')
                    ->with('error', 'Profil dokter belum dibuat oleh administrator.');
            }

            return view('doctor.profile.edit', compact('user', 'doctor'));
        }

        return abort(403);
    }

    /**
     * Update the doctor's profile.
     * Handles both User table fields and Doctor table fields.
     */
    public function doctorUpdate(Request $request)
    {
        if (auth()->check() && auth()->user()->role === 'doctor') {
            $user   = auth()->user();
            $doctor = $user->doctor;

            if (!$doctor) {
                abort(404, 'Doctor profile not found.');
            }

            $request->validate([
                'name'             => 'required|string|max:255',
                'email'            => 'required|email|max:255|unique:users,email,' . $user->id,
                'phone_number'     => 'nullable|string|max:20',
                'specialization'   => 'required|string|max:255',
                'experience_years' => 'required|integer|min:0',
                'bio'              => 'nullable|string|max:2000',
                'address'          => 'nullable|string|max:500',
                'image'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);

            // --- Update User table ---
            $user->update([
                'name'         => $request->name,
                'email'        => $request->email,
                'phone_number' => $request->phone_number,
            ]);

            // --- Handle image upload ---
            $imagePath = $doctor->image; // Keep existing if no new upload
            if ($request->hasFile('image')) {
                // Delete old image if it exists (optional: if using local storage)
                if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
                $imagePath = $request->file('image')->store('images/doctors', 'public');
            }

            // --- Update Doctor table ---
            $doctor->update([
                'name'             => $request->name,
                'specialization'   => $request->specialization,
                'experience_years' => $request->experience_years,
                'bio'              => $request->bio,
                'address'          => $request->address,
                'image'            => $imagePath,
                'phone_number'     => $request->phone_number,
            ]);

            return redirect()->route('doctor.profile.show')
                ->with('success', 'Profil dokter berhasil diperbarui!');
        }

        return abort(403);
    }
}
