<?php

namespace App\Livewire\Admin\Berita;

use App\Models\Berita;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public $berita;
    public $judul;
    public $gambar_berita;
    public $isi_berita;

    public function mount($beritaId){
        $this->berita = Berita::find($beritaId);
        $this->judul = $this->berita->judul;
        $this->isi_berita = $this->berita->isi_berita;
    }

    public function update(){
        $validated = $this->validate([
            'judul' => 'required|string',
            'gambar_berita' => 'nullable|image|max:1024',
            'isi_berita' => 'required|string',
        ]);

        if($this->gambar_berita){
            if($this->berita->gambar_berita && Storage::disk('public')->exists($this->berita->gambar_berita)){
                Storage::disk('public')->delete($this->berita->gambar_berita);
            }
            
            $validated['gambar_berita'] = $this->gambar_berita->store('berita', 'public');
        } else {
            $validated['gambar_berita'] = $this->berita->gambar_berita;
        }

        $this->berita->update($validated);

        session()->flash('success', 'Berita berhasil diedit.');
        return $this->redirect(route('admin.berita.index'), navigate: true);
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.berita.edit');
    }
}