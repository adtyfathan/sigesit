<?php

namespace App\Livewire\Admin\Produk;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

class Show extends Component
{
    public $produk;

    public function mount($produkId){
        if (!Auth::check() || Auth::user()->role_id != 2) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $this->produk = Produk::with('kategori')->find($produkId);
    }
    
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.produk.show');
    }
}