<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\ConsultationMessages;
use Illuminate\Http\Request;

class ConsultationMessageController extends Controller
{
    public function index(Consultation $consultation)
    {
        $user   = auth()->user();
        $booking = $consultation->booking;

        $isParticipant =
            ($user->role === 'member'  && $booking->user_id   === $user->id) ||
            ($user->role === 'doctor'  && $booking->doctor->user_id === $user->id) ||
            ($user->role === 'admin');

        if (!$isParticipant) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $messages = $consultation->consultation_messages()
            ->with('sender:id,name,role')
            ->orderBy('sent_at')
            ->get()
            ->map(function ($msg) use ($user) {
                return [
                    'id'          => $msg->id,
                    'sender_name' => $msg->sender->name ?? 'Unknown',
                    'sender_role' => $msg->sender->role ?? '',
                    'message'     => $msg->message,
                    'sent_at'     => $msg->sent_at->format('H:i'),
                    'is_mine'     => $msg->sender_id === $user->id,
                ];
            });

        return response()->json($messages);
    }

    public function store(Request $request, Consultation $consultation)
    {
        if ($consultation->status !== 'ongoing') {
            return response()->json(['error' => 'Konsultasi sudah ditutup.'], 422);
        }

        $user    = auth()->user();
        $booking = $consultation->booking;

        $isParticipant =
            ($user->role === 'member' && $booking->user_id          === $user->id) ||
            ($user->role === 'doctor' && $booking->doctor->user_id  === $user->id);

        if (!$isParticipant) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $msg = ConsultationMessages::create([
            'consultation_id' => $consultation->id,
            'sender_id'       => $user->id,
            'message'         => $request->message,
            'sent_at'         => now(),
        ]);

        $msg->load('sender:id,name,role');

        return response()->json([
            'id'          => $msg->id,
            'sender_name' => $msg->sender->name,
            'sender_role' => $msg->sender->role,
            'message'     => $msg->message,
            'sent_at'     => $msg->sent_at->format('H:i'),
            'is_mine'     => true,
        ], 201);
    }
}
