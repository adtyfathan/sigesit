<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SkmSeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(1, 3) as $i) {
            $skor_layanan = rand(1, 10);
            $skor_fasilitas = rand(1, 10);
            $skor_petugas = rand(1, 10);
            $skor_aksesibilitas = rand(1, 10);
            $total_skor = ($skor_layanan + $skor_fasilitas + $skor_petugas + $skor_aksesibilitas) / 4;

            DB::table('skm')->insert([
                'total_skor' => $total_skor,
                'skor_layanan' => $skor_layanan,
                'skor_fasilitas' => $skor_fasilitas,
                'skor_petugas' => $skor_petugas,
                'skor_aksesibilitas' => $skor_aksesibilitas,
                'komentar' => rand(0, 1) ? Str::random(30) : null,
                'user_id' => 1,
                'transaksi_id' => $i,
                'tanggal_survey' => Carbon::now()->subDays(rand(0, 30)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}