<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            CategoriesSeeder::class,
            DoctorsSeeder::class,
            DoctorSchedulesSeeder::class,
            ArticlesSeeder::class,
            BookingsSeeder::class,
            ConsultationsSeeder::class,
            // TransactionsSeeder::class,
        ]);
    }
}
