<?php

namespace App\Livewire\Admin\Berita;

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
    public $editingCommentId = null;
    public $editingCommentText = '';

    public function mount($beritaId){
        if (!Auth::check() || Auth::user()->role_id != 2) {
            abort(403, 'Anda tidak memiliki akses.');
        }
        
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

        // Reset the form
        $this->komentarBaru = '';
        
        // Refresh comments
        $this->refreshComments();

        session()->flash('success', 'Komentar berhasil ditambahkan.');
        $this->dispatch('comment-added');
    }

    public function deleteComment($commentId){
        $comment = KomentarBerita::find($commentId);
    
        // role administrator
        if(Auth::user()->role_id !==  2){
            session()->flash('error', 'Anda tidak punya akses untuk menghapus komentar ini.');
            return;
        }

        $comment->delete();
        
        // Refresh comments
        $this->refreshComments();

        session()->flash('success', 'Komentar berhasil dihapus.');
        $this->dispatch('comment-deleted');
    }

    public function editComment($commentId){
        $comment = KomentarBerita::find($commentId);
        
        if($comment->user_id !== Auth::user()->id){
            session()->flash('error', 'Anda tidak punya akses untuk mengedit komentar ini.');
            return;
        }

        $this->editingCommentId = $commentId;
        $this->editingCommentText = $comment->isi_komentar;
    }

    public function updateComment(){
        $validated = $this->validate([
            'editingCommentText' => 'required|string'
        ]);

        $comment = KomentarBerita::find($this->editingCommentId);
        
        if($comment->user_id !== Auth::user()->id){
            session()->flash('error', 'Anda tidak punya akses untuk mengedit komentar ini.');
            return;
        }

        $comment->update([
            'isi_komentar' => $validated['editingCommentText']
        ]);

        // Reset editing state
        $this->editingCommentId = null;
        $this->editingCommentText = '';
        
        // Refresh comments
        $this->refreshComments();

        session()->flash('success', 'Komentar berhasil diperbarui.');
        $this->dispatch('comment-updated');
    }

    public function cancelEdit(){
        $this->editingCommentId = null;
        $this->editingCommentText = '';
    }

    private function refreshComments(){
        $this->berita->load('komentarBerita.user');
        $this->komentars = $this->berita->komentarBerita;
    }

    public function copyLink()
    {
        $this->dispatch('link-copied');
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.berita.show');
    }
}