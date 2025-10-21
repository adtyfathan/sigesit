<?php

namespace App\Livewire\Skm;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use App\Models\Transaksi;
use App\Models\Skm;
use Illuminate\Validation\Rule;

class Create extends Component
{
    public $transaksi;
    public $skorFasilitas;
    public $skorPetugas;
    public $skorAksesibilitas;
    public $skorPengiriman;
    public $komentar;
    
    public function mount($transaksiId){
        if (!Auth::check() || Auth::user()->role_id != 1) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $this->transaksi = Transaksi::with(
            'produk',
            'stasiun'
        )->find($transaksiId);       
        
        if($this->transaksi == null){
            abort(404, 'Transaksi tidak ditemukan.');
        }

        $isSubmitted = Skm::where('transaksi_id', $this->transaksi->id)
            ->where('user_id', Auth::user()->id)
            ->exists();

        if($isSubmitted){
            abort(403, 'Anda sudah mengisi survey ini.');
        }
    }

    public function store(){
        $validated = $this->validate([
            'skorFasilitas' => 'required|numeric|min:1|max:10',
            'skorPetugas' => 'required|numeric|min:1|max:10',
            'skorAksesibilitas' => 'required|numeric|min:1|max:10',
            'skorPengiriman' => 'required|numeric|min:1|max:10',
            'komentar' => 'nullable|string',
        ]);

        $skorLayanan = (
            $validated['skorFasilitas']
             + $validated['skorPetugas'] 
             + $validated['skorAksesibilitas'] 
             + $validated['skorPengiriman']) 
             / 4;

        Skm::create([
            'skor_layanan' => $skorLayanan,
            'skor_fasilitas' => $validated['skorFasilitas'],
            'skor_petugas' => $validated['skorPetugas'],
            'skor_aksesibilitas' => $validated['skorAksesibilitas'],
            'skor_pengiriman' => $validated['skorPengiriman'],
            'komentar' => $validated['komentar'],
            'user_id' => Auth::user()->id,
            'transaksi_id' => $this->transaksi->id,
            'tanggal_survey' => now(),
        ]);

        // dd($skm);
        session()->flash('success', 'Survey berhasil disimapan.');
        return $this->redirect(route(
            'transaksi.show', 
            $this->transaksi->id
        ), navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.skm.create');
    }
}