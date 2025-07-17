<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\Berita;
use App\Models\Produk;

#[Layout('layouts.app')]
class Home extends Component
{
    public $latestBeritas = [];

    public function mount()
    {
        if (!Auth::check() || Auth::user()->role_id != 1) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $this->latestBeritas = Berita::latest()->take(3)->get();
    }

    public function render()
    {
        return view('livewire.home');
    }
}