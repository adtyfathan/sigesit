<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\SkmResult;
use Carbon\Carbon;

#[Layout('layouts.app')] 
class SkmPage extends Component
{
    public $chartData = [];
    public $chartLabels = [];

    public function mount()
    {
        $this->loadTrendData();
    }

    public function loadTrendData()
        {
            // Query untuk mengambil rata-rata skor IKM per bulan
            $monthlyData = SkmResult::selectRaw('YEAR(survey_date) as year, MONTH(survey_date) as month, AVG(ikm_score) as avg_score')
                ->where('survey_date', '>=', Carbon::now()->subMonths(12)->startOfMonth()) // Pastikan filter ini sesuai rentang data Anda
                ->groupBy('year', 'month')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get();

            $labels = [];
            $data = [];

            // Loop untuk membuat label dan mengisi data untuk 12 bulan terakhir
            // Dimulai dari 11 bulan yang lalu hingga bulan saat ini
            for ($i = 11; $i >= 0; $i--) {
                $date = Carbon::now()->subMonths($i);
                $labels[] = $date->translatedFormat('M Y'); // Ini akan menghasilkan 'Aug 2024', 'Sep 2024', ..., 'Jul 2025'

                // Cari data rata-rata untuk bulan ini dari hasil query
                $foundData = $monthlyData->first(function($item) use ($date) {
                    return $item->year == $date->year && $item->month == $date->month;
                });

                // Jika data ditemukan, gunakan skornya; jika tidak, biarkan null
                $data[] = $foundData ? round($foundData->avg_score, 2) : null;
            }

            $this->chartLabels = $labels;
            $this->chartData = $data;
        }

        public function render()
        {
            return view('livewire.skm-page');
        }
    }