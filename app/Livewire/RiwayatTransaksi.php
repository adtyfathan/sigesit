<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use App\Models\Transaksi;
use App\Models\Skm;

class RiwayatTransaksi extends Component
{
    public $transaksis;

    public function mount()
    {
        if (!Auth::check() || Auth::user()->role_id != 1) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $this->transaksis = Transaksi::with(
            'produk.kategori',
                'stasiun'
            )
            ->where('user_id', Auth::user()->id)
            ->get();
    }

    public function submittedSkm($transaksiId){
        $isSubmittedSkm = Skm::where('transaksi_id', $transaksiId)
            ->where('user_id', Auth::user()->id)
            ->exists();

        return $isSubmittedSkm;
    }

    public function getStatusColorClass($transaksiStatus)
    {
        return match($transaksiStatus){
            'success' => 'bg-green-50 text-green-800 border-green-200',
            'pending' => 'bg-yellow-50 text-yellow-800 border-yellow-200',
            'failed' => 'bg-red-50 text-red-800 border-red-200',
            default => 'bg-gray-50 text-gray-800 border-gray-200'
        };
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.riwayat-transaksi');
    }
}