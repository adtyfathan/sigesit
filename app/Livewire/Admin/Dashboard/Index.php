<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Produk;
use App\Models\Berita;
use App\Models\Kategori;
use App\Models\Transaksi;

class Index extends Component
{
    public $users;
    public $produks;
    public $beritas;
    public $kategoris;
    public $umums;
    public $admins;
    public $operators;
    public $bendaharas;
    public $transaksis;

    public function mount(){
        if (!Auth::check() || Auth::user()->role_id != 2) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $this->users = User::get();
        $this->produks = Produk::get();
        $this->beritas = Berita::get();
        $this->kategoris = Kategori::get();
        $this->umums = $this->users->where('role_id', 1);
        $this->admins = $this->users->where('role_id', 2); 
        $this->operators = $this->users->where('role_id', 3);
        $this->bendaharas = $this->users->where('role_id', 4);
        $this->transaksis = Transaksi::get();
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.dashboard.index');
    }
}