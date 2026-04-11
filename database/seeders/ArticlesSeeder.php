<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('articles')->insert([
            [
                'title' => 'Tips Menjaga Kesehatan di Musim Hujan',
                'slug' => 'tips-menjaga-kesehatan-di-musim-hujan',
                'content' => 'Musim hujan seringkali membawa berbagai penyakit seperti flu, batuk, dan demam. Untuk menjaga kesehatan, pastikan Anda mengonsumsi makanan bergizi, menjaga kebersihan diri, serta menggunakan pakaian hangat saat beraktivitas di luar rumah.',
                'thumbnail' => 'thumbnails/musim-hujan.jpg',
                'author_id' => 1,
                'category' => 'Kesehatan Umum',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pentingnya Pola Makan Seimbang untuk Tubuh',
                'slug' => 'pentingnya-pola-makan-seimbang',
                'content' => 'Pola makan seimbang sangat penting untuk menjaga kesehatan tubuh. Konsumsi karbohidrat, protein, lemak sehat, vitamin, dan mineral dalam jumlah yang cukup dapat membantu meningkatkan daya tahan tubuh dan mencegah berbagai penyakit.',
                'thumbnail' => 'thumbnails/pola-makan.jpg',
                'author_id' => 1,
                'category' => 'Nutrisi',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Manfaat Olahraga Rutin bagi Kesehatan Mental',
                'slug' => 'manfaat-olahraga-untuk-kesehatan-mental',
                'content' => 'Olahraga tidak hanya bermanfaat bagi kesehatan fisik, tetapi juga kesehatan mental. Aktivitas fisik secara rutin dapat membantu mengurangi stres, meningkatkan mood, dan memperbaiki kualitas tidur.',
                'thumbnail' => 'thumbnails/olahraga.jpg',
                'author_id' => 1,
                'category' => 'Kesehatan Mental',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
