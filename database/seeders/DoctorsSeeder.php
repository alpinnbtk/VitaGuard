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
                'user_id' => 7,
                'name' => 'Dr. Ahmad Hidayat',
                'specialization' => 'Dokter Umum',
                'gender' => 'male',
                'experience_years' => 5,
                'bio' => 'Dr. Ahmad Hidayat merupakan dokter umum dengan pengalaman kurang lebih 5 tahun.',
                'price' => 50000.00,
                'rating' => 4.90,
                'image' => 'images/doctors/doctor1.png',
                'address' => 'Jl. Kesehatan No. ' . rand(1, 100) . ', Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
                'email' => 'ahmad.hidayat@hospital.com',
                'phone_number' => '081322334455'
            ],
            [
                'user_id' => 8,
                'name' => 'Dr. Sari Wulandari',
                'specialization' => 'Spesialis Anak',
                'gender' => 'female',
                'experience_years' => 8,
                'bio' => 'Dr. Sari Wulandari merupakan dokter spesialis anak dengan pengalaman kurang lebih 8 tahun.',
                'price' => 75000.00,
                'rating' => 4.70,
                'image' => 'images/doctors/doctor2.png',
                'address' => 'Jl. Kesehatan No. ' . rand(1, 100) . ', Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
                'email' => 'sari.wulandari@clinic.com',
                'phone_number' => '082233445566'
            ],
            [
                'user_id' => 9,
                'name' => 'Dr. Bambang Sutrisno',
                'specialization' => 'Spesialis Penyakit Dalam',
                'gender' => 'male',
                'experience_years' => 10,
                'bio' => 'Dr. Bambang Sutrisno merupakan dokter senior dalam bidang penyakit dalam dengan pengalaman kurang lebih 10 tahun.',
                'price' => 100000.00,
                'rating' => 4.80,
                'image' => 'images/doctors/doctor3.png',
                'address' => 'Jl. Kesehatan No. ' . rand(1, 100) . ', Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
                'email' => 'bambang.sutrisno@medic.id',
                'phone_number' => '081355667788'
            ],
            [
                'user_id' => 10,
                'name' => 'Dr. Lina Kartika',
                'specialization' => 'Spesialis Kulit & Kelamin',
                'gender' => 'female',
                'experience_years' => 6,
                'bio' => 'Dr. Lina Kartika merupakan dokter spesialis kulit dan kelamin dengan pengalaman kurang lebih 6 tahun.',
                'price' => 85000.00,
                'rating' => 4.60,
                'image' => 'images/doctors/doctor4.png',
                'address' => 'Jl. Kesehatan No. ' . rand(1, 100) . ', Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
                'email' => 'lina.kartika@healthcare.id',
                'phone_number' => '0235328472'
            ],
            [
                'user_id' => 11,
                'name' => 'Dr. Rizal Maulana',
                'specialization' => 'Spesialis Jantung',
                'gender' => 'male',
                'experience_years' => 12,
                'bio' => 'Dr. Rizal Maulana merupakan dokter senior spesialis penyakit jantung dengan pengalaman hingga 12 tahun dalam dunia kesehatan.',
                'price' => 150000.00,
                'rating' => 4.95,
                'image' => 'images/doctors/doctor5.png',
                'address' => 'Jl. Kesehatan No. ' . rand(1, 100) . ', Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
                'email' => 'rizal.maulana@hospital.com',
                'phone_number' => '085712345678'
            ],
        ]);
    }
}
