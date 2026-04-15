<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'category_name' => 'Kesehatan Umum',
                'description' => 'Informasi dan tips seputar kesehatan umum untuk kehidupan sehari-hari',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Nutrisi & Diet',
                'description' => 'Panduan pola makan sehat, nutrisi, dan program diet yang tepat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Kesehatan Mental',
                'description' => 'Artikel seputar kesehatan mental, manajemen stres, dan keseimbangan emosi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Kesehatan Anak',
                'description' => 'Informasi kesehatan untuk anak-anak, imunisasi, dan tumbuh kembang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Penyakit & Pencegahan',
                'description' => 'Penjelasan berbagai penyakit, gejala, serta cara pencegahannya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
