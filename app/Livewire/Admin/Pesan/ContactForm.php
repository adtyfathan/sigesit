<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Contact; 
use Illuminate\Validation\ValidationException; 

class ContactForm extends Component
{
    public $name;
    public $email;
    public $subject;
    public $message;

    // Aturan validasi untuk form
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'nullable|string|max:255',
        'message' => 'required|string|min:10',
    ];

    public function submitForm()
    {
        try {
            $this->validate(); // Validasi input

            // Simpan data ke database
            Contact::create([
                'name' => $this->name,
                'email' => $this->email,
                'subject' => $this->subject,
                'message' => $this->message,
            ]);

            // Reset field form setelah berhasil
            $this->reset(['name', 'email', 'subject', 'message']);

            // Kirim pesan sukses ke sesi
            session()->flash('message', 'Pesan Anda telah berhasil dikirim!');

        } catch (ValidationException $e) {
            // Tangani error validasi
            session()->flash('error', 'Terjadi kesalahan validasi. Mohon periksa kembali input Anda.');
            throw $e; // Lempar kembali exception agar Livewire menampilkan error
        } catch (\Exception $e) {
            // Tangani error lain (misalnya masalah database)
            session()->flash('error', 'Maaf, terjadi kesalahan saat mengirim pesan Anda. Silakan coba lagi nanti.');
            // Anda bisa log error ini untuk debugging
    }
}
    public function render()
    {
        return view('livewire.contact');
    }
}