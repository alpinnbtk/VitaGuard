<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transactions')->insert([
            [
                'user_id' => 2, // andika92
                'doctor_id' => 1, // Dr. Ahmad
                'consultation_date' => Carbon::now()->subDays(5),
                'status' => 'completed',
                'total_price' => 50000.00,
                'notes' => 'Konsultasi demam dan batuk',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3, // siti84
                'doctor_id' => 2, // Dr. Sari
                'consultation_date' => Carbon::now()->subDays(3),
                'status' => 'completed',
                'total_price' => 75000.00,
                'notes' => 'Konsultasi tumbuh kembang anak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4, // budi73
                'doctor_id' => 3, // Dr. Bambang
                'consultation_date' => Carbon::now()->subDays(1),
                'status' => 'confirmed',
                'total_price' => 100000.00,
                'notes' => 'Pemeriksaan rutin penyakit dalam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5, // dewi61
                'doctor_id' => 4, // Dr. Lina
                'consultation_date' => Carbon::now()->addDays(2),
                'status' => 'pending',
                'total_price' => 85000.00,
                'notes' => 'Konsultasi masalah kulit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 6, // rizky45
                'doctor_id' => 5, // Dr. Rizal
                'consultation_date' => Carbon::now()->addDays(5),
                'status' => 'pending',
                'total_price' => 150000.00,
                'notes' => 'Konsultasi kesehatan jantung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // andika92
                'doctor_id' => 5, // Dr. Rizal
                'consultation_date' => Carbon::now()->subDays(10),
                'status' => 'cancelled',
                'total_price' => 150000.00,
                'notes' => 'Dibatalkan oleh pasien',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
