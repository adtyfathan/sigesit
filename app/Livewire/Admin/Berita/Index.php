<?php

namespace App\Livewire\Admin\Berita;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Berita;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $beritas = [];

    public function mount()
    {
        if (!Auth::check() || Auth::user()->role_id != 2) {
            abort(403, 'Anda tidak memiliki akses.');
        }
        
        $this->beritas = Berita::get();
    }

    public function delete($beritaId){
        Berita::find($beritaId)->delete();

        session()->flash('message', 'Berita berhasil dihapus.');
        
        return $this->redirect(route('admin.berita.index'), navigate: true);
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.berita.index');
    }
}