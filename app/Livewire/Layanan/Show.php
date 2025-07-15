<?php

namespace App\Livewire\Layanan;

use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\Produk;
use Livewire\Component;

class Show extends Component
{
    public $produk;
    public $showFullDescription = false;
    public $activeTab = 'overview';
    
    public function mount($produkId)
    {
        if (!Auth::check() || Auth::user()->role_id != 1) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $this->produk = Produk::with('kategori')->find($produkId);
        
        if (!$this->produk) {
            abort(404, 'Produk tidak ditemukan.');
        }
    }

    public function toggleDescription()
    {
        $this->showFullDescription = !$this->showFullDescription;
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function formatPrice($price)
    {
        return 'Rp ' . number_format($price, 0, ',', '.');
    }

    public function copyLink()
    {
        $this->dispatch('link-copied');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.layanan.show');
    }
}