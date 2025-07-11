<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class Hubungi extends Component
{
    public $name;
    public $email;
    public $message;

    public function mount(){
        if (!Auth::check() || Auth::user()->role_id != 1) {
            abort(403, 'Anda tidak memiliki akses.');
        }
    }

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'message' => 'required|min:10',
    ];

    public function submitForm()
    {
        $this->validate();

        // Di sini Anda bisa menambahkan logika untuk mengirim email atau menyimpan pesan ke database
        // Contoh sederhana:
        // Mail::to('admin@websiteanda.com')->send(new ContactFormMail($this->name, $this->email, $this->message));

        session()->flash('message', 'Terima kasih! Pesan Anda telah terkirim.');

        // Reset form
        $this->reset(['name', 'email', 'message']);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.hubungi');
    }
}