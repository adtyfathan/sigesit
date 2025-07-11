<?php

namespace App\Livewire\Admin\Berita;

use App\Models\Berita;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    use WithFileUploads;
    public $judul;
    public $gambar_berita;
    public $isi_berita;
    
    public function mount(){
        if (!Auth::check() || Auth::user()->role_id != 2) {
            abort(403, 'Anda tidak memiliki akses.');
        }
    }

    public function store(){
        $validated = $this->validate([
            'judul' => 'required|string',
            'gambar_berita' => 'nullable|image|max:1024',
            'isi_berita' => 'required|string',
        ]);

        if($this->gambar_berita){
            $path = $this->gambar_berita->store('berita', 'public');
            $validated['gambar_berita'] = $path;
        }

        $validated['tanggal_berita'] = Carbon::now();

        Berita::create($validated);

        session()->flash('success', 'Berita berhasil dibuat.');
        return $this->redirect(route('admin.berita.index'), navigate: true);
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.berita.create');
    }
}