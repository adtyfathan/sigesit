<?php

namespace App\Livewire\Admin\Kategori;

use App\Models\Kategori;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    public $kategori;
    
    public $nama_kategori;
    
    public function mount($kategoriId){
        if (!Auth::check() || Auth::user()->role_id != 2) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $this->kategori = Kategori::find($kategoriId);

        $this->nama_kategori = $this->kategori->nama_kategori;
    }  

    public function update(){
        $validated = $this->validate([
            'nama_kategori' => 'required|string'
        ]);

        $this->kategori->update($validated);
        
        session()->flash('success', 'Kategori berhasil diedit.');
        return $this->redirect(route('admin.kategori.index'), navigate: true);
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.kategori.edit');
    }
}