<?php

namespace App\Livewire\Layanan;

use App\Models\Produk;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $produks = [];
    public $search = '';

    public function mount(){
        if (!Auth::check() || Auth::user()->role_id != 1) {
            abort(403, 'Anda tidak memiliki akses.');
        }
        
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