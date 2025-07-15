<?php

namespace App\Livewire\Admin\Produk;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Kategori;
use App\Models\Produk;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

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
        if (!Auth::check() || Auth::user()->role_id != 2) {
            abort(403, 'Anda tidak memiliki akses.');
        }
  
        $this->kategoris = Kategori::get();
    }

    public function store(){
        $validated = $this->validate([
            'nama_produk' => 'required|string',
            'harga_produk' => 'required|numeric',
            'gambar_produk' => 'nullable|image|max:1024',
            'deskripsi_produk' => 'nullable|string',
            'wilayah_peta' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori,id',
        ]);

        if($this->gambar_produk){
            $path = $this->gambar_produk->store('produk', 'public');
            $validated['gambar_produk'] = $path;
        }        

        Produk::create($validated);

        session()->flash('success', 'Produk berhasil dibuat.');
        return $this->redirect(route('admin.produk.index'), navigate: true);
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.produk.create');
    }
}