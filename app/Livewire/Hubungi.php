<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact; 
use Illuminate\Validation\ValidationException;  
use Illuminate\Support\Facades\Log; 

class Hubungi extends Component
{
    public $name;
    public $email;
    public $subject; // <<< MENAMBAHKAN PROPERTI SUBJECT
    public $message;

    public function mount(){
        if (!Auth::check() || Auth::user()->role_id != 1) {
            abort(403, 'Anda tidak memiliki akses.');
        }
    }

    protected $rules = [
        'name' => 'required|string|max:255', // Lebih spesifik: string, max length
        'email' => 'required|email|max:255', // Lebih spesifik: email, max length
        'subject' => 'nullable|string|max:255', // <<< ATURAN UNTUK SUBJECT (opsional)
        'message' => 'required|string|min:10', // Lebih spesifik: string
    ];

    public function submitForm()
    {
        try {
            $this->validate(); // Lakukan validasi sesuai rules di atas

            // --- LOGIKA PENYIMPANAN DATA KE DATABASE ---
            Contact::create([ // Menggunakan model Contact untuk menyimpan ke tabel 'contacts'
                'name' => $this->name,
                'email' => $this->email,
                'subject' => $this->subject, // <<< SIMPAN JUGA SUBJECT
                'message' => $this->message,
                'is_read' => false, // Default: pesan belum dibaca
            ]);

            session()->flash('message', 'Pesan Anda telah berhasil dikirim!');

            // Reset form
            $this->reset(['name', 'email', 'subject', 'message']); 

        } catch (ValidationException $e) {
            Log::error('Validation failed for Hubungi form: ' . json_encode($e->errors()));
            throw $e;
        } catch (\Exception $e) {
            session()->flash('error', 'Maaf, terjadi kesalahan saat mengirim pesan Anda. Silakan coba lagi nanti.');
            Log::error('General error submitting Hubungi form: ' . $e->getMessage() . ' - Trace: ' . $e->getTraceAsString());
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.hubungi');
    }
}