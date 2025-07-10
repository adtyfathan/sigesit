<?php

namespace App\Livewire\Berita;

use App\Models\Berita;
use App\Models\KomentarBerita;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Show extends Component
{
    public $berita;
    public $komentars = [];
    public $komentarBaru = '';
    
    public function mount($beritaId){
        $this->berita = Berita::with('komentarBerita.user')
            ->find($beritaId);

        $this->komentars = $this->berita->komentarBerita;
    }

    public function storeComment(){
        $validated = $this->validate([
            'komentarBaru' => 'required|string'
        ]);

        KomentarBerita::create([
            'isi_komentar' => $validated['komentarBaru'],
            'tanggal_komentar' => now(),
            'berita_id' => $this->berita->id,
            'user_id' => Auth::user()->id
        ]);

        session()->flash('success', 'Komentar berhasil ditambahkan.');
        return $this->redirect(route('berita.show', $this->berita->id), navigate: true);
    }
    
    public function copyLink()
    {
        $this->dispatch('link-copied');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.berita.show');
    }
}