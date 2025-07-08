<?php

namespace App\Livewire\Layanan;

use App\Models\Produk;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Index extends Component
{
    public $produks = [];
    public $search = '';

    public function mount(){
        $this->produks = Produk::get();
    }

    public function updatedSearch()
    {
        $this->searchProduk();
    }

    public function searchProduk()
    {
        if (empty($this->search)) {
            $this->produks = Produk::get();
        } else {
            $this->produks = Produk::where('nama_produk', 'like', '%' . $this->search . '%')
                ->orWhere('deskripsi_produk', 'like', '%' . $this->search . '%')
                ->orWhere('wilayah_peta', 'like', '%' . $this->search . '%')
                ->get();
        }
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->produks = Produk::get();
    }
        
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.layanan.index');
    }
}