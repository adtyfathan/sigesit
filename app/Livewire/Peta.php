<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout; 
use Illuminate\Support\Facades\Auth;
 
#[Layout('layouts.app')] 
class Peta extends Component
{
    public function mount(){
        if (!Auth::check() || Auth::user()->role_id != 1) {
            abort(403, 'Anda tidak memiliki akses.');
        }
    }
    public function render()
    {
        return view('livewire.peta');
    }
}

