<?php

namespace App\Livewire\Berita;

use App\Models\Berita;
use App\Models\KomentarBerita;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

#[Layout('layouts.app')]
class Show extends Component
{
    public $berita;
    public $komentars = [];
    public $komentarBaru = '';
    
    public $editingCommentId = null;
    public $editingCommentText = '';
    
    public $relatedBeritas = [];

    public function mount($beritaId)
    {
        $this->berita = Berita::with(['komentarBerita' => function($query) {
            $query->with('user')->orderBy('created_at', 'desc');
        }])->find($beritaId);

        if (!$this->berita) {
            abort(404);
        }

        $this->komentars = $this->berita->komentarBerita;

        $this->loadRelatedBeritas();
    }

    public function storeComment()
    {
        if (!Auth::check()) {
            Session::flash('error', 'Anda harus login untuk berkomentar.');
            return;
        }

        $this->validate([
            'komentarBaru' => 'required|string|min:3|max:500',
        ], [
            'komentarBaru.required' => 'Komentar tidak boleh kosong.',
            'komentarBaru.min' => 'Komentar terlalu pendek (minimal 3 karakter).',
            'komentarBaru.max' => 'Komentar terlalu panjang (maksimal 500 karakter).',
        ]);

        KomentarBerita::create([
            'isi_komentar' => $this->komentarBaru,
            'tanggal_komentar' => Carbon::now(),
            'berita_id' => $this->berita->id,
            'user_id' => Auth::id()
        ]);

        $this->komentarBaru = '';
        $this->refreshComments();
        Session::flash('success', 'Komentar berhasil ditambahkan.');
        $this->dispatch('comment-added');
    }
    
    public function deleteComment($commentId)
    {
        $comment = KomentarBerita::find($commentId);
    
        if (!$comment || (Auth::check() && $comment->user_id !== Auth::id())) {
            Session::flash('error', 'Anda tidak punya akses untuk menghapus komentar ini.');
            return;
        }
        if (!Auth::check()) {
            Session::flash('error', 'Anda harus login untuk menghapus komentar.');
            return;
        }

        $comment->delete();
        $this->refreshComments();
        Session::flash('success', 'Komentar berhasil dihapus.');
        $this->dispatch('comment-deleted');
    }

    public function editComment($commentId)
    {
        $comment = KomentarBerita::find($commentId);
        
        if (!$comment || (Auth::check() && $comment->user_id !== Auth::id())) {
            Session::flash('error', 'Anda tidak punya akses untuk mengedit komentar ini.');
            return;
        }
        if (!Auth::check()) {
            Session::flash('error', 'Anda harus login untuk mengedit komentar.');
            return;
        }

        $this->editingCommentId = $commentId;
        $this->editingCommentText = $comment->isi_komentar;
    }

    public function updateComment()
    {
        $this->validate([
            'editingCommentText' => 'required|string|min:3|max:500',
        ], [
            'editingCommentText.required' => 'Komentar tidak boleh kosong.',
            'editingCommentText.min' => 'Komentar terlalu pendek (minimal 3 karakter).',
            'editingCommentText.max' => 'Komentar terlalu panjang (maksimal 500 karakter).',
        ]);

        $comment = KomentarBerita::find($this->editingCommentId);
        
        if (!$comment || (Auth::check() && $comment->user_id !== Auth::id())) {
            Session::flash('error', 'Anda tidak punya akses untuk mengedit komentar ini.');
            return;
        }
        if (!Auth::check()) {
            Session::flash('error', 'Anda harus login untuk memperbarui komentar.');
            return;
        }

        $comment->update([
            'isi_komentar' => $this->editingCommentText
        ]);

        $this->cancelEdit();
        $this->refreshComments();
        Session::flash('success', 'Komentar berhasil diperbarui.');
        $this->dispatch('comment-updated');
    }

    public function cancelEdit()
    {
        $this->editingCommentId = null;
        $this->editingCommentText = '';
    }

    private function refreshComments()
    {
        $this->berita->load(['komentarBerita' => function($query) {
            $query->with('user')->orderBy('created_at', 'desc');
        }]);
        $this->komentars = $this->berita->komentarBerita;
    }

    private function loadRelatedBeritas()
    {
        $this->relatedBeritas = Berita::where('id', '!=', $this->berita->id)
                                      ->latest()
                                      ->take(5)
                                      ->get();
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