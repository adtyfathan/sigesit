<?php

namespace App\Livewire\Admin\Produk;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Produk;

class Show extends Component
{
    public $produk;

    public function mount($produkId){
        $this->produk = Produk::with('kategori')->find($produkId);
    }
    
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.produk.show');
    }
}