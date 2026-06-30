<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorSchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('doctor_schedules')->insert([
            ['doctor_id' => 1, 'day' => 'Senin', 'start_time' => '09:00:00', 'end_time' => '11:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['doctor_id' => 1, 'day' => 'Rabu',  'start_time' => '13:00:00', 'end_time' => '15:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['doctor_id' => 1, 'day' => 'Jumat', 'start_time' => '16:00:00', 'end_time' => '18:00:00', 'created_at' => now(), 'updated_at' => now()],

            ['doctor_id' => 2, 'day' => 'Selasa', 'start_time' => '13:30:00', 'end_time' => '15:30:00', 'created_at' => now(), 'updated_at' => now()],
            ['doctor_id' => 2, 'day' => 'Kamis',  'start_time' => '09:00:00', 'end_time' => '11:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['doctor_id' => 2, 'day' => 'Sabtu',  'start_time' => '10:00:00', 'end_time' => '12:00:00', 'created_at' => now(), 'updated_at' => now()],

            ['doctor_id' => 3, 'day' => 'Senin', 'start_time' => '10:00:00', 'end_time' => '12:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['doctor_id' => 3, 'day' => 'Rabu',  'start_time' => '14:00:00', 'end_time' => '16:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['doctor_id' => 3, 'day' => 'Jumat', 'start_time' => '08:00:00', 'end_time' => '10:00:00', 'created_at' => now(), 'updated_at' => now()],

            ['doctor_id' => 4, 'day' => 'Selasa', 'start_time' => '15:00:00', 'end_time' => '17:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['doctor_id' => 4, 'day' => 'Kamis',  'start_time' => '09:30:00', 'end_time' => '11:30:00', 'created_at' => now(), 'updated_at' => now()],
            ['doctor_id' => 4, 'day' => 'Sabtu',  'start_time' => '13:00:00', 'end_time' => '15:00:00', 'created_at' => now(), 'updated_at' => now()],

            ['doctor_id' => 5, 'day' => 'Senin', 'start_time' => '08:30:00', 'end_time' => '10:30:00', 'created_at' => now(), 'updated_at' => now()],
            ['doctor_id' => 5, 'day' => 'Rabu',  'start_time' => '11:00:00', 'end_time' => '13:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['doctor_id' => 5, 'day' => 'Jumat', 'start_time' => '15:30:00', 'end_time' => '17:30:00', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
