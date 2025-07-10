<?php
namespace Database\Seeders;

use App\Models\SkmResult;
use Illuminate\Database\Seeder;
use Carbon\Carbon; // Pastikan Carbon diimpor

class SkmResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama jika ada, agar tidak duplikasi dan hanya data terbaru yang tersisa
        SkmResult::truncate();

        // Data untuk 12 bulan terakhir (dari Agustus 2024 hingga Juli 2025)
        for ($i = 11; $i >= 0; $i--) { // Dari 11 bulan lalu hingga bulan ini
            $date = Carbon::now()->subMonths($i);
            $year = $date->year;
            $month = $date->month;

            // Generate 20-50 dummy data per bulan
            $numRecords = rand(20, 50);
            for ($j = 0; $j < $numRecords; $j++) {
                SkmResult::create([
                    'ikm_score' => rand(70, 95), // Skor IKM antara 70-95
                    'comment' => 'Komentar dummy untuk bulan ' . $date->format('M Y'),
                    'service_aspect' => ['Pelayanan A', 'Pelayanan B', 'Pelayanan C'][array_rand(['Pelayanan A', 'Pelayanan B', 'Pelayanan C'])],
                    'survey_date' => $date->startOfMonth()->addDays(rand(0, $date->daysInMonth - 1)),
                ]);
            }
        }
    }
}