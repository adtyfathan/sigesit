<?php

namespace App\Livewire\Admin\Produk;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Kategori;
use App\Models\Produk;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $kategoris = [];
    public $nama_produk;
    public $harga_produk;
    public $gambar_produk;
    public $deskripsi_produk;
    public $wilayah_peta;
    public $kategori_id;
    
    public function mount(){
        $this->kategoris = Kategori::get();
    }

    public function store(){
        $produk = $this->validate([
            'nama_produk' => 'required|string',
            'harga_produk' => 'required|numeric',
            'gambar_produk' => 'nullable|image|max:1024',
            'deskripsi_produk' => 'nullable|string',
            'wilayah_peta' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori,id',
        ]);

        $path = $this->gambar_produk->store('produk', 'public');
        $produk['gambar_produk'] = $path;

        Produk::create($produk);

        session()->flash('success', 'Produk berhasil dibuat.');
        return $this->redirect(route('admin.produk.index'), navigate: true);
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.produk.create');
    }
}