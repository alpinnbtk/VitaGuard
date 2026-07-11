<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsultationMessagesSeeder extends Seeder
{
    /**
     * Seed sample chat messages for the ongoing consultation (id=1).
     * Booking 1 → user_id=1 (Andika, member), doctor_id=1 (Ahmad, user_id=7).
     */
    public function run(): void
    {
        DB::table('consultation_messages')->insert([
            // Member opens the conversation
            [
                'consultation_id' => 1,
                'sender_id'       => 2, // Andika Pratama (member)
                'message'         => 'Selamat pagi, Dokter. Saya ingin konsultasi mengenai keluhan yang saya alami.',
                'sent_at'         => now()->subMinutes(30),
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            // Doctor replies
            [
                'consultation_id' => 1,
                'sender_id'       => 7, // Dr. Ahmad Hidayat (doctor)
                'message'         => 'Selamat pagi! Silakan ceritakan keluhan Anda secara detail.',
                'sent_at'         => now()->subMinutes(28),
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            // Member continues
            [
                'consultation_id' => 1,
                'sender_id'       => 2,
                'message'         => 'Sudah 2 hari saya mengalami demam ringan dan sakit kepala. Suhu badan sekitar 37.5 derajat.',
                'sent_at'         => now()->subMinutes(25),
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            // Doctor advises
            [
                'consultation_id' => 1,
                'sender_id'       => 7,
                'message'         => 'Baik. Apakah disertai dengan batuk, pilek, atau nyeri tenggorokan?',
                'sent_at'         => now()->subMinutes(22),
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            // Member answers
            [
                'consultation_id' => 1,
                'sender_id'       => 2,
                'message'         => 'Ada sedikit pilek, tapi batuk tidak ada. Tenggorokan sedikit sakit.',
                'sent_at'         => now()->subMinutes(18),
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ]);
    }
}
