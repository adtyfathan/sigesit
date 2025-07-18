<?php

namespace App\Livewire\Admin\Pesan;

use Livewire\Component;
use App\Models\Contact; 
use Livewire\WithPagination; 
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class Pesan extends Component
{
    use WithPagination; 

    public $search = '';
    public $selectedMessage = null; // Untuk menyimpan pesan yang sedang dilihat dalam modal
    public $showModal = false; // Untuk mengontrol tampilan modal

    // Atur nama pagination untuk menghindari konflik jika ada lebih dari satu pagination di halaman
    protected $paginationTheme = 'tailwind';

    // Metode untuk mereset pagination saat pencarian berubah
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Metode untuk menampilkan detail pesan dalam modal
    public function viewMessage($messageId)
    {
        $message = Contact::find($messageId);
        if ($message) {
            $this->selectedMessage = $message;
            $this->selectedMessage->is_read = true; // Tandai pesan sudah dibaca
            $this->selectedMessage->save();
            $this->showModal = true;
        }
    }

    // Metode untuk menutup modal
    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedMessage = null;
    }

    // Metode untuk menghapus pesan
    public function deleteMessage($messageId)
    {
        $message = Contact::find($messageId);
        if ($message) {
            $message->delete();
            session()->flash('message', 'Pesan berhasil dihapus!');
        } else {
            session()->flash('error', 'Pesan tidak ditemukan.');
        }
    }

    public function render()
    {
        // Ambil pesan dari database dengan filter pencarian dan pagination
        $messages = Contact::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('subject', 'like', '%' . $this->search . '%')
                      ->orWhere('message', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc') // Urutkan dari terbaru
            ->paginate(10); // Tampilkan 10 pesan per halaman

        return view('livewire.admin.pesan.pesan', [
            'messages' => $messages,
        ]);
    }
}