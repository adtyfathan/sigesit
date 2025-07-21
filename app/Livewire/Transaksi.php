<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use App\Models\Transaksi as TransaksiModel;

class Transaksi extends Component
{
    public $transaksi;
    public $produk;
    
    public function mount($transaksiId){
        if (!Auth::check() || Auth::user()->role_id != 1) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $this->transaksi = TransaksiModel::with('produk')->find($transaksiId);

        if(Auth::user()->id !== $this->transaksi->user_id) {
            abort(403, 'Anda tidak memiliki akses ke transaksi ini.');
        }

        $this->produk = $this->transaksi->produk;
    }

    
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.transaksi');
    }
}