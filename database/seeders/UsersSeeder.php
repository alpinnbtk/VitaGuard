<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'username' => 'andika92',
            'password' => Hash::make('password123'),
            'email' => 'andika.pratama@gmail.com',
            'phone_number' => '081234567890',
            'role' => 'member',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'username' => 'siti84',
            'password' => Hash::make('password123'),
            'email' => 'siti.rahmawati@gmail.com',
            'phone_number' => '082134567891',
            'role' => 'member',
            'email_verified_at' => null,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'username' => 'budi73',
            'password' => Hash::make('password123'),
            'email' => 'budi.santoso@yahoo.com',
            'phone_number' => '081298765432',
            'role' => 'member',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'username' => 'dewi61',
            'password' => Hash::make('password123'),
            'email' => 'dewi.lestari@gmail.com',
            'phone_number' => null,
            'role' => 'member',
            'email_verified_at' => null,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'username' => 'rizky45',
            'password' => Hash::make('password123'),
            'email' => 'rizky.firmansyah@gmail.com',
            'phone_number' => '083812345678',
            'role' => 'member',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ],

        // ===== DOCTOR =====
        [
            'username' => 'ahmad77',
            'password' => Hash::make('password123'),
            'email' => 'ahmad.hidayat@hospital.com',
            'phone_number' => '081322334455',
            'role' => 'doctor',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'username' => 'sari66',
            'password' => Hash::make('password123'),
            'email' => 'sari.wulandari@clinic.com',
            'phone_number' => '082233445566',
            'role' => 'doctor',
            'email_verified_at' => null,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'username' => 'bambang58',
            'password' => Hash::make('password123'),
            'email' => 'bambang.sutrisno@medic.id',
            'phone_number' => '081355667788',
            'role' => 'doctor',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'username' => 'lina49',
            'password' => Hash::make('password123'),
            'email' => 'lina.kartika@healthcare.id',
            'phone_number' => null,
            'role' => 'doctor',
            'email_verified_at' => null,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'username' => 'rizal36',
            'password' => Hash::make('password123'),
            'email' => 'rizal.maulana@hospital.com',
            'phone_number' => '085712345678',
            'role' => 'doctor',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ],
        ]);
    }
}
