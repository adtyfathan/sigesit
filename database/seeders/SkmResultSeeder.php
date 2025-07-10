<?php
namespace Database\Seeders;

use App\Models\SkmResult;
use Illuminate\Database\Seeder;
use Carbon\Carbon; 

class SkmResultSeeder extends Seeder
{
    public function run(): void
    {
        SkmResult::truncate();

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $year = $date->year;
            $month = $date->month;

            $numRecords = rand(20, 50);
            for ($j = 0; $j < $numRecords; $j++) {
                SkmResult::create([
                    'ikm_score' => rand(70, 95), 
                    'comment' => 'Komentar dummy untuk bulan ' . $date->format('M Y'),
                    'service_aspect' => ['Pelayanan A', 'Pelayanan B', 'Pelayanan C'][array_rand(['Pelayanan A', 'Pelayanan B', 'Pelayanan C'])],
                    'survey_date' => $date->startOfMonth()->addDays(rand(0, $date->daysInMonth - 1)),
                ]);
            }
        }
    }
}