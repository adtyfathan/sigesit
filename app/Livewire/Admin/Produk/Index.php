<?php

namespace App\Livewire\Admin\Produk;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Produk;

class Index extends Component
{
    public $produks = [];

    public function mount()
    {
        $this->produks = Produk::get()->load('kategori');
    }

    public function delete($produkId){
        Produk::find($produkId)->delete();

        session()->flash('message', 'Produk berhasil dihapus.');

        return $this->redirect(route('admin.produk.index'), navigate: true);
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.produk.index');
    }
}