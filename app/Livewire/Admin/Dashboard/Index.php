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
    public $currentYear;
    public $skmDatas;
    public $bidangDatas = [];
    public $layananDatas = [];
    public $trenDatas = []; 
    public $distribusiLabels = [];
    public $distribusiDatas = [];   

    public function mount(){
        if (!Auth::check() || Auth::user()->role_id != 2) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $this->loadData();   
    }

    public function loadData(){
        $this->users = User::get();
        $this->produks = Produk::get();
        $this->beritas = Berita::get();
        $this->kategoris = Kategori::get();
        $this->umums = $this->users->where('role_id', 1);
        $this->admins = $this->users->where('role_id', 2); 
        $this->operators = $this->users->where('role_id', 3);
        $this->bendaharas = $this->users->where('role_id', 4);
        $this->transaksis = Transaksi::get();
        $this->skmDatas = Skm::get();

        // SKM
        $this->bidangDatas = $this->calcBidangDatas();
        $this->layananDatas = $this->calcLayananData();
        $this->trenDatas = $this->calcTrenData();
        $this->distribusiDatas = $this->calcDistribusiData();
    }

    public function calcBidangDatas(){
        $fasilitasValue = 0;
        $petugasValue = 0;
        $aksesibilitasValue = 0;

        foreach($this->skmDatas as $skm){
            $fasilitasValue += $skm->skor_fasilitas;
            $petugasValue += $skm->skor_petugas;
            $aksesibilitasValue += $skm->skor_aksesibilitas;
        }

        $jumlahDataSkm = count($this->skmDatas);

        $fasilitasValue = $fasilitasValue / $jumlahDataSkm;
        $petugasValue = $petugasValue / $jumlahDataSkm;
        $aksesibilitasValue = $aksesibilitasValue / $jumlahDataSkm;

        return [$fasilitasValue, $petugasValue, $aksesibilitasValue];
    }

    public function calcLayananData(){
        $kurang = 0;
        $cukup = 0;
        $puas = 0;
        $sangatPuas = 0;

        foreach($this->skmDatas as $skm){
            if ($skm->skor_layanan === 'kurang'){
                $kurang += 1;
            } else if ($skm->skor_layanan === 'cukup'){
                $cukup += 1;
            } else if ($skm->skor_layanan === 'puas'){
                $puas += 1;
            } else if ($skm->skor_layanan === 'sangat puas'){
                $sangatPuas += 1;
            }
        }
        
        return [$kurang, $cukup, $puas, $sangatPuas];
    }

    public function calcTrenData(){
        $this->currentYear = Carbon::now()->year;
    
        $monthlyData = array_fill(0, 12, 0);
        
        $surveyCounts = Skm::select(
                DB::raw('MONTH(tanggal_survey) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->whereYear('tanggal_survey', $this->currentYear)
            ->groupBy(DB::raw('MONTH(tanggal_survey)'))
            ->orderBy(DB::raw('MONTH(tanggal_survey)'))
            ->get();
        
        foreach ($surveyCounts as $surveyCount) {
            $monthlyData[$surveyCount->month - 1] = $surveyCount->count;
        }
        
        return $monthlyData;
    }

    public function calcDistribusiData(){
        $counts = Skm::join('transaksi', 'skm.transaksi_id', '=', 'transaksi.id')
            ->join('produk', 'transaksi.produk_id', '=', 'produk.id')
            ->select('produk.id', DB::raw('count(skm.id) as jumlah_survey'))
            ->groupBy('produk.id')
            ->pluck('jumlah_survey', 'produk.id');
        
        $result = [];
        
        foreach ($this->produks as $produk) {
            $this->distribusiLabels[] = $produk->nama_produk;
            $result[] = $counts[$produk->id] ?? 0;
        }

        return $result;
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.dashboard.index', [
            'skms' => Skm::with('user', 'transaksi.produk')->paginate(10),
        ]);
    }
}