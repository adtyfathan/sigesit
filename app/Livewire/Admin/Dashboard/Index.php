<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Produk;
use App\Models\Berita;
use App\Models\Kategori;
use App\Models\Transaksi;
use App\Models\Skm;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $users;
    public $produks;
    public $beritas;
    public $kategoris;
    public $umums;
    public $admins;
    public $operators;
    public $bendaharas;
    public $transaksis;
    public $skmDatas;

    public $chartData;

    public function mount()
    {
        if (!Auth::check() || Auth::user()->role_id != 2) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $this->loadAllData();
    }
    
    // Semua data dimuat di sini, termasuk data chart
    public function loadAllData()
    {
        $this->users = User::all();
        $this->produks = Produk::all();
        $this->beritas = Berita::all();
        $this->kategoris = Kategori::all();
        $this->transaksis = Transaksi::all();
        $this->skmDatas = Skm::all();

        $this->umums = $this->users->where('role_id', 1);
        $this->admins = $this->users->where('role_id', 2);
        $this->operators = $this->users->where('role_id', 3);
        $this->bendaharas = $this->users->where('role_id', 4);

        $this->prepareChartData();
    }

    private function prepareChartData()
    {
        $skmsCollection = collect($this->skmDatas);

        $avgFasilitas = round($skmsCollection->avg('skor_fasilitas') ?? 0, 1);
        $avgPetugas = round($skmsCollection->avg('skor_petugas') ?? 0, 1);
        $avgAksesibilitas = round($skmsCollection->avg('skor_aksesibilitas') ?? 0, 1);
        $avgPengiriman = round($skmsCollection->avg('skor_pengiriman') ?? 0, 1);

        $kepuasanOverall = [
            'kurang' => 0,
            'cukup' => 0,
            'puas' => 0,
            'sangat_puas' => 0,
        ];
        foreach ($skmsCollection as $skm) {
            $calculatedLayanan = (
                ($skm->skor_fasilitas ?? 0) +
                ($skm->skor_petugas ?? 0) +
                ($skm->skor_aksesibilitas ?? 0) +
                ($skm->skor_pengiriman ?? 0)
            ) / 4;

            if ($calculatedLayanan > 8) {
                $kepuasanOverall['sangat_puas']++;
            } elseif ($calculatedLayanan > 6) {
                $kepuasanOverall['puas']++;
            } elseif ($calculatedLayanan > 4) {
                $kepuasanOverall['cukup']++;
            } else {
                $kepuasanOverall['kurang']++;
            }
        }

        $monthlyAverages = function ($scoreColumn) use ($skmsCollection) {
            return $skmsCollection->groupBy(function ($data) {
                return Carbon::parse($data->created_at)->format('Y-m');
            })->map(function ($group) use ($scoreColumn) {
                $validScores = $group->filter(function ($item) use ($scoreColumn) {
                    return isset($item->$scoreColumn) && is_numeric($item->$scoreColumn);
                })->pluck($scoreColumn);
                return $validScores->count() > 0 ? round($validScores->avg(), 1) : null;
            })->sortKeys();
        };

        $trendLabels = [];
        $trendFasilitasData = [];
        $trendPetugasData = [];
        $trendAksesibilitasData = [];
        $trendPengirimanData = [];

        $startDateForChart = Carbon::now()->subMonths(11)->startOfMonth();
        $currentMonth = $startDateForChart->copy();
        while ($currentMonth->lessThanOrEqualTo(Carbon::now())) {
            $monthKey = $currentMonth->format('Y-m');
            $trendLabels[] = $currentMonth->format('M Y');

            $trendFasilitasData[] = $monthlyAverages('skor_fasilitas')->get($monthKey) ?? null;
            $trendPetugasData[] = $monthlyAverages('skor_petugas')->get($monthKey) ?? null;
            $trendAksesibilitasData[] = $monthlyAverages('skor_aksesibilitas')->get($monthKey) ?? null;
            $trendPengirimanData[] = $monthlyAverages('skor_pengiriman')->get($monthKey) ?? null;

            $currentMonth->addMonth();
        }

        $distribusiLabels = [];
        $distribusiDatas = [];

        $counts = Skm::join('transaksi', 'skm.transaksi_id', '=', 'transaksi.id')
            ->join('produk', 'transaksi.produk_id', '=', 'produk.id')
            ->select('produk.nama_produk', DB::raw('count(skm.id) as jumlah_survey'))
            ->groupBy('produk.nama_produk')
            ->pluck('jumlah_survey', 'produk.nama_produk');

        foreach ($this->produks as $produk) {
            $distribusiLabels[] = $produk->nama_produk;
            $distribusiDatas[] = $counts[$produk->nama_produk] ?? 0;
        }

        $this->chartData = [
            'avgFasilitas' => $avgFasilitas,
            'avgPetugas' => $avgPetugas,
            'avgAksesibilitas' => $avgAksesibilitas,
            'avgPengiriman' => $avgPengiriman,
            'kepuasanOverall' => $kepuasanOverall,
            'trendLabels' => $trendLabels,
            'trendFasilitasData' => $trendFasilitasData,
            'trendPetugasData' => $trendPetugasData,
            'trendAksesibilitasData' => $trendAksesibilitasData,
            'trendPengirimanData' => $trendPengirimanData,
            'distribusiLabels' => $distribusiLabels,
            'distribusiDatas' => $distribusiDatas,
        ];
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.dashboard.index', [
            'skms' => Skm::with('user', 'transaksi.produk')->paginate(10),
        ]);
    }
}