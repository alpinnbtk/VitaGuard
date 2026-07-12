<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make('password123'),
                'email' => 'admin@vitaguard.com',
                'phone_number' => '081200000000',
                'photo' => 'http',
                'role' => 'admin',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Andika Pratama',
                'username' => 'andika92',
                'password' => Hash::make('password123'),
                'email' => 'andika.pratama@gmail.com',
                'phone_number' => '081234567890',
                'photo' => 'http',
                'role' => 'member',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Siti Rahmawati',
                'username' => 'siti84',
                'password' => Hash::make('password123'),
                'email' => 'siti.rahmawati@gmail.com',
                'phone_number' => '082134567891',
                'photo' => 'http',
                'role' => 'member',
                'email_verified_at' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Budi Santoso',
                'username' => 'budi73',
                'password' => Hash::make('password123'),
                'email' => 'budi.santoso@yahoo.com',
                'phone_number' => '081298765432',
                'photo' => 'http',
                'role' => 'member',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Dewi Lestari',
                'username' => 'dewi61',
                'password' => Hash::make('password123'),
                'email' => 'dewi.lestari@gmail.com',
                'phone_number' => null,
                'photo' => 'http',
                'role' => 'member',
                'email_verified_at' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Rizky Firmansyah',
                'username' => 'rizky45',
                'password' => Hash::make('password123'),
                'email' => 'rizky.firmansyah@gmail.com',
                'phone_number' => '083812345678',
                'photo' => 'http',
                'role' => 'member',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Dr. Ahmad Hidayat',
                'username' => 'ahmad77',
                'password' => Hash::make('password123'),
                'email' => 'ahmad.hidayat@hospital.com',
                'phone_number' => '081322334455',
                'photo' => 'http',
                'role' => 'doctor',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Dr. Sari Wulandari',
                'username' => 'sari66',
                'password' => Hash::make('password123'),
                'email' => 'sari.wulandari@clinic.com',
                'phone_number' => '082233445566',
                'photo' => 'http',
                'role' => 'doctor',
                'email_verified_at' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Dr. Bambang Sutrisno',
                'username' => 'bambang58',
                'password' => Hash::make('password123'),
                'email' => 'bambang.sutrisno@medic.id',
                'phone_number' => '081355667788',
                'photo' => 'http',
                'role' => 'doctor',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Dr. Lina Kartika',
                'username' => 'lina49',
                'password' => Hash::make('password123'),
                'email' => 'lina.kartika@healthcare.id',
                'phone_number' => null,
                'photo' => 'http',
                'role' => 'doctor',
                'email_verified_at' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Dr. Rizal Maulana',
                'username' => 'rizal36',
                'password' => Hash::make('password123'),
                'email' => 'rizal.maulana@hospital.com',
                'phone_number' => '085712345678',
                'photo' => 'http',
                'role' => 'doctor',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
