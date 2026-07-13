<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsultationMessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('consultation_messages')->insert([
            [
                'consultation_id' => 1,
                'sender_id'       => 2,
                'message'         => 'Selamat pagi, Dokter. Saya ingin konsultasi mengenai keluhan yang saya alami.',
                'sent_at'         => now()->subMinutes(30),
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'consultation_id' => 1,
                'sender_id'       => 7,
                'message'         => 'Selamat pagi! Silakan ceritakan keluhan Anda secara detail.',
                'sent_at'         => now()->subMinutes(28),
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'consultation_id' => 1,
                'sender_id'       => 2,
                'message'         => 'Sudah 2 hari saya mengalami demam ringan dan sakit kepala. Suhu badan sekitar 37.5 derajat.',
                'sent_at'         => now()->subMinutes(25),
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'consultation_id' => 1,
                'sender_id'       => 7,
                'message'         => 'Baik. Apakah disertai dengan batuk, pilek, atau nyeri tenggorokan?',
                'sent_at'         => now()->subMinutes(22),
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
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
