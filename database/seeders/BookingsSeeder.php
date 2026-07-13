<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('bookings')->insert([
            [
                'user_id' => 2, 'doctor_id' => 1, 'doctor_schedule_id' => 1,
                'booking_date' => '2026-02-02', 'booking_time' => '09:00:00',
                'status' => 'completed', 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id' => 3, 'doctor_id' => 2, 'doctor_schedule_id' => 4,
                'booking_date' => '2026-02-03', 'booking_time' => '13:30:00',
                'status' => 'completed', 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id' => 4, 'doctor_id' => 5, 'doctor_schedule_id' => 14,
                'booking_date' => '2026-02-11', 'booking_time' => '11:00:00',
                'status' => 'completed', 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id' => 5, 'doctor_id' => 3, 'doctor_schedule_id' => 9,
                'booking_date' => '2026-02-13', 'booking_time' => '08:00:00',
                'status' => 'cancelled', 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id' => 3, 'doctor_id' => 5, 'doctor_schedule_id' => 13,
                'booking_date' => '2026-03-02', 'booking_time' => '08:30:00',
                'status' => 'completed', 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id' => 6, 'doctor_id' => 2, 'doctor_schedule_id' => 5,
                'booking_date' => '2026-03-05', 'booking_time' => '09:00:00',
                'status' => 'completed', 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id' => 2, 'doctor_id' => 1, 'doctor_schedule_id' => 2,
                'booking_date' => '2026-03-11', 'booking_time' => '13:00:00',
                'status' => 'confirmed', 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id' => 4, 'doctor_id' => 3, 'doctor_schedule_id' => 7,
                'booking_date' => '2026-04-06', 'booking_time' => '10:00:00',
                'status' => 'completed', 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id' => 5, 'doctor_id' => 4, 'doctor_schedule_id' => 10,
                'booking_date' => '2026-04-07', 'booking_time' => '15:00:00',
                'status' => 'cancelled', 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id' => 2, 'doctor_id' => 2, 'doctor_schedule_id' => 5,
                'booking_date' => '2026-04-09', 'booking_time' => '09:00:00',
                'status' => 'completed', 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id' => 6, 'doctor_id' => 1, 'doctor_schedule_id' => 1,
                'booking_date' => '2026-05-04', 'booking_time' => '09:00:00',
                'status' => 'completed', 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id' => 3, 'doctor_id' => 3, 'doctor_schedule_id' => 8,
                'booking_date' => '2026-05-06', 'booking_time' => '14:00:00',
                'status' => 'confirmed', 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id' => 4, 'doctor_id' => 5, 'doctor_schedule_id' => 15,
                'booking_date' => '2026-05-08', 'booking_time' => '15:30:00',
                'status' => 'completed', 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id' => 5, 'doctor_id' => 4, 'doctor_schedule_id' => 11,
                'booking_date' => '2026-05-14', 'booking_time' => '09:30:00',
                'status' => 'pending', 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id' => 2, 'doctor_id' => 5, 'doctor_schedule_id' => 13,
                'booking_date' => '2026-06-01', 'booking_time' => '08:30:00',
                'status' => 'confirmed', 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id' => 6, 'doctor_id' => 1, 'doctor_schedule_id' => 2,
                'booking_date' => '2026-06-03', 'booking_time' => '13:00:00',
                'status' => 'completed', 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id' => 3, 'doctor_id' => 2, 'doctor_schedule_id' => 6,
                'booking_date' => '2026-06-06', 'booking_time' => '10:00:00',
                'status' => 'completed', 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id' => 4, 'doctor_id' => 3, 'doctor_schedule_id' => 8,
                'booking_date' => '2026-07-01', 'booking_time' => '14:00:00',
                'status' => 'confirmed', 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id' => 5, 'doctor_id' => 1, 'doctor_schedule_id' => 1,
                'booking_date' => '2026-07-06', 'booking_time' => '09:00:00',
                'status' => 'pending', 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'user_id' => 2, 'doctor_id' => 4, 'doctor_schedule_id' => 10,
                'booking_date' => '2026-07-07', 'booking_time' => '15:00:00',
                'status' => 'pending', 'created_at' => now(), 'updated_at' => now(),
            ],
        ]);
    }
}
