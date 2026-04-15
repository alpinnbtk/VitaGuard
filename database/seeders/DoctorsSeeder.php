<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('doctors')->insert([
            [
                'user_id' => 7, // ahmad77
                'name' => 'Dr. Ahmad Hidayat',
                'specialization' => 'Dokter Umum',
                'email' => 'ahmad.hidayat@hospital.com',
                'phone_number' => '081322334455',
                'gender' => 'male',
                'address' => 'Jl. Soekarno Hatta No. 10, Surabaya',
                'experience_years' => 5,
                'price' => 50000.00,
                'rating' => 4.90,
                'photo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 8, // sari66
                'name' => 'Dr. Sari Wulandari',
                'specialization' => 'Spesialis Anak',
                'email' => 'sari.wulandari@clinic.com',
                'phone_number' => '082233445566',
                'gender' => 'female',
                'address' => 'Jl. Diponegoro No. 25, Malang',
                'experience_years' => 8,
                'price' => 75000.00,
                'rating' => 4.70,
                'photo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 9, // bambang58
                'name' => 'Dr. Bambang Sutrisno',
                'specialization' => 'Spesialis Penyakit Dalam',
                'email' => 'bambang.sutrisno@medic.id',
                'phone_number' => '081355667788',
                'gender' => 'male',
                'address' => 'Jl. Ahmad Yani No. 50, Jakarta',
                'experience_years' => 10,
                'price' => 100000.00,
                'rating' => 4.80,
                'photo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 10, // lina49
                'name' => 'Dr. Lina Kartika',
                'specialization' => 'Spesialis Kulit & Kelamin',
                'email' => 'lina.kartika@healthcare.id',
                'phone_number' => '081244556677',
                'gender' => 'female',
                'address' => 'Jl. Sudirman No. 15, Bandung',
                'experience_years' => 6,
                'price' => 85000.00,
                'rating' => 4.60,
                'photo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 11, // rizal36
                'name' => 'Dr. Rizal Maulana',
                'specialization' => 'Spesialis Jantung',
                'email' => 'rizal.maulana@hospital.com',
                'phone_number' => '085712345678',
                'gender' => 'male',
                'address' => 'Jl. Gatot Subroto No. 100, Jakarta',
                'experience_years' => 12,
                'price' => 150000.00,
                'rating' => 4.95,
                'photo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
