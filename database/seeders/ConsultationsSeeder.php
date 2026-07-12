<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsultationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('consultations')->insert([
            [
                'booking_id' => 1,
                'started_at' => now(),
                'ended_at' => null,
                'status' => 'ongoing',
                'summary' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 3,
                'started_at' => now()->subDays(2)->setTime(10, 0),
                'ended_at' => now()->subDays(2)->setTime(10, 25),
                'status' => 'closed',
                'summary' => 'Pasien mengeluh demam ringan dan batuk, diberikan saran istirahat dan obat penurun panas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 5,
                'started_at' => now()->subDays(1)->setTime(8, 30),
                'ended_at' => now()->subDays(1)->setTime(9, 0),
                'status' => 'closed',
                'summary' => 'Konsultasi rutin kontrol jantung, kondisi pasien stabil, dianjurkan kontrol kembali 1 bulan lagi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
