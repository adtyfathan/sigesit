<?php

namespace App\Livewire\Admin\Produk;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Show extends Component
{
    
    
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.produk.show');
    }
}