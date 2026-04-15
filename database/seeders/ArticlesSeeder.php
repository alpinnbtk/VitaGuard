<?php

namespace Database\Seeders;

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
                'content' => 'Musim hujan seringkali membawa berbagai penyakit seperti flu, batuk, dan demam. Untuk menjaga kesehatan, pastikan Anda mengonsumsi makanan bergizi, menjaga kebersihan diri, serta menggunakan pakaian hangat saat beraktivitas di luar rumah. Selain itu, perbanyak konsumsi vitamin C dan istirahat yang cukup.',
                'thumbnail' => null,
                'author_id' => 1, // admin
                'category_id' => 1, // Kesehatan Umum
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pentingnya Pola Makan Seimbang untuk Tubuh',
                'slug' => 'pentingnya-pola-makan-seimbang',
                'content' => 'Pola makan seimbang sangat penting untuk menjaga kesehatan tubuh. Konsumsi karbohidrat, protein, lemak sehat, vitamin, dan mineral dalam jumlah yang cukup dapat membantu meningkatkan daya tahan tubuh dan mencegah berbagai penyakit. Pastikan setiap porsi makan mengandung sayuran, buah-buahan, dan sumber protein yang baik.',
                'thumbnail' => null,
                'author_id' => 1,
                'category_id' => 2, // Nutrisi & Diet
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Manfaat Olahraga Rutin bagi Kesehatan Mental',
                'slug' => 'manfaat-olahraga-untuk-kesehatan-mental',
                'content' => 'Olahraga tidak hanya bermanfaat bagi kesehatan fisik, tetapi juga kesehatan mental. Aktivitas fisik secara rutin dapat membantu mengurangi stres, meningkatkan mood, dan memperbaiki kualitas tidur. Mulailah dengan olahraga ringan seperti jalan kaki 30 menit setiap hari untuk merasakan manfaatnya.',
                'thumbnail' => null,
                'author_id' => 1,
                'category_id' => 3, // Kesehatan Mental
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Panduan Imunisasi Lengkap untuk Anak',
                'slug' => 'panduan-imunisasi-lengkap-untuk-anak',
                'content' => 'Imunisasi merupakan langkah penting dalam melindungi anak dari berbagai penyakit berbahaya. Pastikan anak Anda mendapatkan imunisasi sesuai jadwal yang direkomendasikan oleh dokter. Vaksin dasar yang wajib diberikan meliputi BCG, DPT, Polio, Campak, dan Hepatitis B.',
                'thumbnail' => null,
                'author_id' => 1,
                'category_id' => 4, // Kesehatan Anak
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Mengenal Gejala Diabetes dan Cara Pencegahannya',
                'slug' => 'mengenal-gejala-diabetes-dan-pencegahannya',
                'content' => 'Diabetes mellitus adalah penyakit kronis yang ditandai dengan kadar gula darah tinggi. Gejala umum meliputi sering haus, sering buang air kecil, penurunan berat badan tanpa sebab, dan mudah lelah. Pencegahan dapat dilakukan dengan menjaga pola makan, rutin berolahraga, dan memeriksakan kadar gula darah secara berkala.',
                'thumbnail' => null,
                'author_id' => 1,
                'category_id' => 5, // Penyakit & Pencegahan
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
