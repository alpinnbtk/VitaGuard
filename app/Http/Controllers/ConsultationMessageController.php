<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\ConsultationMessages;
use Illuminate\Http\Request;

class ConsultationMessageController extends Controller
{
    /**
     * Fetch all messages for a given consultation (AJAX polling).
     * Returns a JSON array of message objects with sender info.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Consultation $consultation)
    {
        // Ensure only participants can read messages
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

    /**
     * Store a new message in a consultation (AJAX).
     * Validates the consultation is still ongoing and the sender is a participant.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Consultation $consultation)
    {
        // Guard: consultation must be active
        if ($consultation->status !== 'ongoing') {
            return response()->json(['error' => 'Konsultasi sudah ditutup.'], 422);
        }

        // Guard: only participants can send messages
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
