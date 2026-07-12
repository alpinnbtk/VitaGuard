<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('members')->insert([
            [
                'user_id'       => 2,
                'date_of_birth' => '1995-03-14',
                'gender'        => 'male',
                'address'       => 'Jl. Raya Darmo No. 12, Surabaya',
                'blood_type'    => 'O',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'user_id'       => 3,
                'date_of_birth' => '1998-07-22',
                'gender'        => 'female',
                'address'       => 'Jl. Pemuda No. 45, Surabaya',
                'blood_type'    => 'A',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'user_id'       => 4,
                'date_of_birth' => '1990-11-05',
                'gender'        => 'male',
                'address'       => 'Jl. Diponegoro No. 78, Surabaya',
                'blood_type'    => 'B',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'user_id'       => 5,
                'date_of_birth' => '2000-01-30',
                'gender'        => 'female',
                'address'       => 'Jl. Ahmad Yani No. 99, Surabaya',
                'blood_type'    => 'AB',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'user_id'       => 6,
                'date_of_birth' => '1993-05-17',
                'gender'        => 'male',
                'address'       => 'Jl. Basuki Rahmat No. 33, Surabaya',
                'blood_type'    => 'O',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
