<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
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

    public function update(\Illuminate\Http\Request $request)
    {
        if (auth()->check() && auth()->user()->role === 'member') {
            $user = auth()->user();
            
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:50|unique:users,username,' . $user->id,
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'phone_number' => 'nullable|string|max:20',
                'gender' => 'nullable|in:male,female',
                'date_of_birth' => 'nullable|date',
                'blood_type' => 'nullable|string|max:5',
                'address' => 'nullable|string',
            ]);

            // Update Users Table
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
            ]);

            // Update or Create Members Table
            $user->member()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'gender' => $request->gender,
                    'date_of_birth' => $request->date_of_birth,
                    'blood_type' => $request->blood_type,
                    'address' => $request->address,
                ]
            );

            return redirect()->route('member.profile.show')->with('success', 'Profil berhasil diperbarui!');
        }
        
        return abort(403);
    }
}
