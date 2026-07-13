<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsultationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('consultations')->insert([
            [
                'booking_id' => 1,
                'started_at' => '2026-02-02 09:05:00',
                'ended_at'   => '2026-02-02 09:28:00',
                'status'     => 'closed',
                'summary'    => 'Pasien mengeluh batuk dan demam ringan. Dokter menyarankan istirahat cukup dan pemberian obat penurun panas serta vitamin C.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'booking_id' => 2,
                'started_at' => '2026-02-03 13:35:00',
                'ended_at'   => '2026-02-03 14:00:00',
                'status'     => 'closed',
                'summary'    => 'Konsultasi tumbuh kembang anak usia 3 tahun. Perkembangan normal, dokter menyarankan vaksinasi booster sesuai jadwal.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'booking_id' => 3,
                'started_at' => '2026-02-11 11:10:00',
                'ended_at'   => '2026-02-11 11:40:00',
                'status'     => 'closed',
                'summary'    => 'Pasien dengan keluhan nyeri dada ringan. EKG dalam batas normal. Dokter menyarankan pemantauan tekanan darah rutin dan diet rendah garam.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'booking_id' => 5,
                'started_at' => '2026-03-02 08:35:00',
                'ended_at'   => '2026-03-02 09:05:00',
                'status'     => 'closed',
                'summary'    => 'Kontrol rutin jantung. Kondisi stabil, tekanan darah terkontrol. Resep obat dilanjutkan, kontrol kembali 1 bulan lagi.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'booking_id' => 6,
                'started_at' => '2026-03-05 09:05:00',
                'ended_at'   => '2026-03-05 09:30:00',
                'status'     => 'closed',
                'summary'    => 'Konsultasi anak dengan keluhan alergi kulit. Dokter merekomendasikan antihistamin dan menghindari pemicu alergi.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'booking_id' => 7,
                'started_at' => '2026-03-11 13:05:00',
                'ended_at'   => null,
                'status'     => 'ongoing',
                'summary'    => null,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'booking_id' => 8,
                'started_at' => '2026-04-06 10:05:00',
                'ended_at'   => '2026-04-06 10:35:00',
                'status'     => 'closed',
                'summary'    => 'Pasien dengan keluhan maag kronis. Dokter memberikan resep antasida dan menyarankan pola makan teratur serta menghindari makanan pedas.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'booking_id' => 10,
                'started_at' => '2026-04-09 09:05:00',
                'ended_at'   => '2026-04-09 09:25:00',
                'status'     => 'closed',
                'summary'    => 'Imunisasi anak lengkap. Tidak ada reaksi alergi pasca vaksin. Jadwal imunisasi berikutnya diberikan.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'booking_id' => 11,
                'started_at' => '2026-05-04 09:05:00',
                'ended_at'   => '2026-05-04 09:20:00',
                'status'     => 'closed',
                'summary'    => 'Pemeriksaan umum pasien dengan keluhan pusing dan mual. Diagnosis vertigo ringan. Dokter meresepkan betahistine dan saran istirahat.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'booking_id' => 12,
                'started_at' => '2026-05-06 14:05:00',
                'ended_at'   => null,
                'status'     => 'ongoing',
                'summary'    => null,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'booking_id' => 13,
                'started_at' => '2026-05-08 15:35:00',
                'ended_at'   => '2026-05-08 16:00:00',
                'status'     => 'closed',
                'summary'    => 'Konsultasi lanjutan pasien jantung. Hasil pemeriksaan membaik, dosis obat disesuaikan. Pasien dianjurkan olahraga ringan secara rutin.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'booking_id' => 15,
                'started_at' => '2026-06-01 08:35:00',
                'ended_at'   => null,
                'status'     => 'ongoing',
                'summary'    => null,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'booking_id' => 16,
                'started_at' => '2026-06-03 13:05:00',
                'ended_at'   => '2026-06-03 13:30:00',
                'status'     => 'closed',
                'summary'    => 'Pasien mengeluh flu berkepanjangan. Dokter menyarankan tes darah untuk memastikan tidak ada infeksi sekunder. Resep antibiotik ringan diberikan.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'booking_id' => 17,
                'started_at' => '2026-06-06 10:05:00',
                'ended_at'   => '2026-06-06 10:35:00',
                'status'     => 'closed',
                'summary'    => 'Konsultasi tumbuh kembang rutin. Berat dan tinggi anak sesuai grafik normal. Dokter merekomendasikan suplementasi zat besi.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'booking_id' => 18,
                'started_at' => '2026-07-01 14:05:00',
                'ended_at'   => null,
                'status'     => 'ongoing',
                'summary'    => null,
                'created_at' => now(), 'updated_at' => now(),
            ],
        ]);
    }
}
