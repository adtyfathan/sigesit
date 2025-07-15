<?php

namespace App\Livewire\Admin\Kategori;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\Kategori;

class Index extends Component
{
    public $kategoris = [];

    public function mount(){
        if (!Auth::check() || Auth::user()->role_id != 2) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $this->kategoris = Kategori::get();
    }   

    public function delete($kategoriId){
        Kategori::find($kategoriId)->delete();

        session()->flash('message', 'Kategori berhasil dihapus.');

        return $this->redirect(route('admin.kategori.index'), navigate: true);
    }
    
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.kategori.index');
    }
}