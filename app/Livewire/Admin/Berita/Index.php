<?php

namespace App\Livewire\Admin\Berita;

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

    public function delete($beritaId){
        Berita::find($beritaId)->delete();

        session()->flash('message', 'Berita berhasil dihapus.');
        
        return $this->redirect(route('admin.produk.index'), navigate: true);
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.berita.index');
    }
}