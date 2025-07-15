<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\Berita;
use App\Models\Produk;

class Home extends Component
{
    public $beritasTerbaru;
    
    public function mount(){
        if (!Auth::check() || Auth::user()->role_id != 1) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $this->beritasTerbaru = Berita::latest()->take(3)->get();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.home');
    }
}