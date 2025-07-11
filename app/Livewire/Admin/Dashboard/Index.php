<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public function mount(){
        if (!Auth::check() || Auth::user()->role_id != 2) {
            abort(403, 'Anda tidak memiliki akses.');
        }
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.dashboard.index');
    }
}