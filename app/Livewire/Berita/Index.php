<?php

namespace App\Livewire\Berita;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Berita;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $beritas = [];

    public function mount()
    {
        if (!Auth::check() || Auth::user()->role_id != 1) {
            abort(403, 'Anda tidak memiliki akses.');
        }
        
        $this->beritas = Berita::get();
    }

    #[Layout('layouts.app')]
    
    public function render()
    {
        return view('livewire.berita.index');
    }
}