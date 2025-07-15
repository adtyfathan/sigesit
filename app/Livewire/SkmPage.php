<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\SkmResult;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class SkmPage extends Component
{
    public $chartData = [];
    public $chartLabels = [];
    public $averageIkmScore = 0;
    public $totalRespondents = 0;
    public $ikmCategory = 'Belum Ada Data';
    public $aspectScores = [
        'Kualitas Pelayanan' => 0,
        'Kecepatan Respon' => 0,
        'Keramahan Staf' => 0,
    ];
    public $recentRespondents = [];

    public function mount()
    {
        // Check if user is authenticated and has role_id 1 (Admin)
        // If this page is accessible to all public, you might remove or adjust this check.
        // Based on your route definition, it seems '/skm' is for users,
        // while admin routes are under '/admin'. You may need to adjust your authentication logic
        // or route structure if this page is truly public-facing.
        // For a public survey report, you'd likely remove the Auth check here.
        if (!Auth::check() || Auth::user()->role_id != 1) {
             // For public view, you can remove this check or make it redirect to login
             // For admin-only view, keep it. Assuming it's for admin to see the report:
             // abort(403, 'Anda tidak memiliki akses untuk melihat laporan ini.');
        }

        $this->loadReportData();
        $this->loadTrendData();
    }

    public function loadReportData()
    {
        $allResults = SkmResult::all(); // Fetch all results from the database

        $this->totalRespondents = $allResults->count();
        $this->averageIkmScore = $this->totalRespondents > 0 ? round($allResults->avg('ikm_score'), 2) : 0;
        $this->ikmCategory = $this->getIkmCategory($this->averageIkmScore);

        // --- Calculate Aspect Percentages ---
        // This part needs careful consideration based on your actual survey structure.
        // If your survey has separate questions for Quality, Speed, Friendliness,
        // you would average those specific question scores here.
        // For demonstration, we'll derive them from the overall IKM score.
        if ($this->totalRespondents > 0) {
            // Example: Derive aspect scores from the overall IKM.
            // In a real scenario, these would come from specific questions in your survey.
            $this->aspectScores['Kualitas Pelayanan'] = min(100, round($this->averageIkmScore * 0.95, 0));
            $this->aspectScores['Kecepatan Respon'] = min(100, round($this->averageIkmScore * 0.90, 0));
            $this->aspectScores['Keramahan Staf'] = min(100, round($this->averageIkmScore * 1.05, 0));
        } else {
            // Default percentages if no data
            $this->aspectScores['Kualitas Pelayanan'] = 0;
            $this->aspectScores['Kecepatan Respon'] = 0;
            $this->aspectScores['Keramahan Staf'] = 0;
        }

        // --- Load Recent Respondents for the table ---
        $this->recentRespondents = SkmResult::orderBy('created_at', 'desc')->take(25)->get();
    }

    public function loadTrendData()
    {
        // Query to get average IKM score per month
        $monthlyData = SkmResult::selectRaw('YEAR(survey_date) as year, MONTH(survey_date) as month, AVG(ikm_score) as avg_score')
            ->where('survey_date', '>=', Carbon::now()->subMonths(11)->startOfMonth()) // Get data for the last 12 months including current
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $labels = [];
        $data = [];

        // Populate labels and data for the last 12 months
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $labels[] = $date->translatedFormat('M Y'); // e.g., 'Jul 2024', 'Aug 2024', ..., 'Jun 2025'

            $foundData = $monthlyData->first(function($item) use ($date) {
                return $item->year == $date->year && $item->month == $date->month;
            });

            $data[] = $foundData ? round($foundData->avg_score, 2) : null;
        }

        $this->chartLabels = $labels;
        $this->chartData = $data;
    }

    // Helper function to determine IKM category
    private function getIkmCategory($score)
    {
        if ($score >= 88.31) {
            return 'Sangat Baik';
        } elseif ($score >= 76.61) {
            return 'Baik';
        } elseif ($score >= 65.00) {
            return 'Cukup Baik';
        } else {
            return 'Kurang Baik';
        }
    }

    public function render()
    {
        return view('livewire.skm-page', [
            // No need to pass variables directly to view() in Livewire render,
            // as public properties are automatically available in the view.
            // But we keep it explicit here for clarity in this example.
            // In a real Livewire setup, you might just do:
            // return view('livewire.skm-page');
            // and access $this->averageIkmScore, etc., directly in the blade.
        ]);
    }
}