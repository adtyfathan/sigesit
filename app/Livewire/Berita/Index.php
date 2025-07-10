<?php

namespace App\Livewire\Berita;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Berita;

class Index extends Component
{
    public $beritas = [];

    public function mount()
    {
        $this->beritas = Berita::get();
    }

    #[Layout('layouts.app')]
    
    public function render()
    {
        return view('livewire.berita.index');
    }
}