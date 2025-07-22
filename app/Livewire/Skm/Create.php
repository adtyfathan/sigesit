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
    public $skorLayanan;
    public $skorFasilitas;
    public $skorPetugas;
    public $skorAksesibilitas;
    public $komentar;
    
    public function mount($transaksiId){
        if (!Auth::check() || Auth::user()->role_id != 1) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $this->transaksi = Transaksi::with('produk')->find($transaksiId);       
        
        if($this->transaksi == null){
            abort(404, 'Transaksi tidak ditemukan.');
        }

        $isSubmitted = Transaksi::where('id', $this->transaksi->id)
            ->where('user_id', Auth::user()->id)
            ->exists();

        if($isSubmitted){
            abort(403, 'Anda sudah mengisi survey ini.');
        }
    }

    public function store(){
        $validated = $this->validate([
            'skorLayanan' => [
                'required',
                'string',
                Rule::in(['kurang', 'cukup', 'puas', 'sangat puas']),
            ],
            'skorFasilitas' => 'required|numeric|min:1|max:10',
            'skorPetugas' => 'required|numeric|min:1|max:10',
            'skorAksesibilitas' => 'required|numeric|min:1|max:10',
            'komentar' => 'nullable|string',
        ]);

        $totalSkor = ($validated['skorFasilitas'] + $validated['skorPetugas'] + $validated['skorAksesibilitas']) / 3;

        Skm::create([
            'total_skor' => $totalSkor,
            'skor_layanan' => $validated['skorLayanan'],
            'skor_fasilitas' => $validated['skorFasilitas'],
            'skor_petugas' => $validated['skorPetugas'],
            'skor_aksesibilitas' => $validated['skorAksesibilitas'],
            'komentar' => $validated['komentar'],
            'user_id' => Auth::user()->id,
            'transaksi_id' => $this->transaksi->id,
            'tanggal_survey' => now(),
        ]);

        session()->flash('success', 'Survey berhasil disimapan.');
        return $this->redirect(route('transaksi.show', $this->transaksi->id), navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.skm.create');
    }
}