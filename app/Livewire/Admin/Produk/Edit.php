<?php

namespace App\Livewire\Admin\Produk;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    use WithFileUploads;

    public $produk;
    public $kategoris = [];
    public $nama_produk;
    public $harga_produk;
    public $gambar_produk;
    public $deskripsi_produk;
    public $wilayah_peta;
    public $kategori_id;

    public function mount($produkId)
    {
        if (!Auth::check() || Auth::user()->role_id != 2) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $this->produk = Produk::find($produkId);
        $this->kategoris = Kategori::get();
        $this->nama_produk = $this->produk->nama_produk;
        $this->harga_produk = $this->produk->harga_produk;
        $this->deskripsi_produk = $this->produk->deskripsi_produk;
        $this->wilayah_peta = $this->produk->wilayah_peta;
        $this->kategori_id = $this->produk->kategori_id;
    }

    public function update(){
        $validated = $this->validate([
            'nama_produk' => 'required|string',
            'harga_produk' => 'required|numeric',
            'gambar_produk' => 'nullable|image|max:1024',
            'deskripsi_produk' => 'nullable|string',
            'wilayah_peta' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori,id',
        ]);
        
        if($this->gambar_produk){
            if($this->produk->gambar_produk && Storage::disk('public')->exists($this->produk->gambar_produk)){
                Storage::disk('public')->delete($this->produk->gambar_produk);
            }

            $validated['gambar_produk'] = $this->gambar_produk->store('produk', 'public');
        } else {
            $validated['gambar_produk'] = $this->produk->gambar_produk;
        }

        $this->produk->update($validated);
        
        session()->flash('success', 'Produk berhasil diedit.');
        return $this->redirect(route('admin.produk.index'), navigate: true);
    }


    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.produk.edit');
    }
}