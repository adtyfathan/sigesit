<?php

namespace App\Livewire\Admin\Kategori;

use App\Models\Kategori;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $nama_kategori;
    
    public function mount(){
        if (!Auth::check() || Auth::user()->role_id != 2) {
            abort(403, 'Anda tidak memiliki akses.');
        }
    }

    public function store(){
        $validated = $this->validate([
            'nama_kategori' => 'required|string'
        ]);

        Kategori::create($validated);

        session()->flash('success', 'Kategori berhasil dibuat.');
        return $this->redirect(route('admin.kategori.index'), navigate: true);
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.kategori.create');
    }
}