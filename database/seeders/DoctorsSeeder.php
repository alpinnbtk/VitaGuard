<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'name' => 'Dr. Gia Pratama',
                'specialization' => 'Dokter Umum',
                'email' => 'gia.pratama@example.com',
                'phone_number' => '081234567890',
                'gender' => 'male',
                'address' => 'Jl. Soekarno Hatta No. 10, Surabaya',
                'experience_years' => 5,
                'price' => 50000.00,
                'rating' => 4.90,
                'photo' => 'doctors/gia.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Siti Rahmawati',
                'specialization' => 'Spesialis Anak',
                'email' => 'siti.rahmawati@example.com',
                'phone_number' => '082345678901',
                'gender' => 'female',
                'address' => 'Jl. Diponegoro No. 25, Malang',
                'experience_years' => 8,
                'price' => 75000.00,
                'rating' => 4.70,
                'photo' => 'doctors/siti.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Budi Santoso',
                'specialization' => 'Spesialis Penyakit Dalam',
                'email' => 'budi.santoso@example.com',
                'phone_number' => '083456789012',
                'gender' => 'male',
                'address' => 'Jl. Ahmad Yani No. 50, Jakarta',
                'experience_years' => 10,
                'price' => 100000.00,
                'rating' => 4.80,
                'photo' => 'doctors/budi.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
