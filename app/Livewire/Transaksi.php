<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use App\Models\Transaksi as TransaksiModel;
use App\Models\Skm;

class Transaksi extends Component
{
    public $transaksi;
    public $produk;
    public $submittedSkm;
    
    public function mount($transaksiId)
    {
        // Check authentication and role authorization
        if (!Auth::check() || Auth::user()->role_id != 1) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        // Load transaction with all necessary relationships
        $this->transaksi = TransaksiModel::with(['produk.kategori', 'user'])->find($transaksiId);

        // Check if transaction exists
        if (!$this->transaksi) {
            abort(404, 'Transaksi tidak ditemukan.');
        }

        // Check transaction ownership
        if (Auth::user()->id !== $this->transaksi->user_id) {
            abort(403, 'Anda tidak memiliki akses ke transaksi ini.');
        }

        $this->produk = $this->transaksi->produk;

        $this->submittedSkm = Skm::where('transaksi_id', $this->transaksi->id)
            ->where('user_id', Auth::user()->id)
            ->exists();
    }

    public function getStatusColorClass()
    {
        return match($this->transaksi->status) {
            'success' => 'bg-green-50 text-green-800 border-green-200',
            'pending' => 'bg-yellow-50 text-yellow-800 border-yellow-200',
            'failed' => 'bg-red-50 text-red-800 border-red-200',
            default => 'bg-gray-50 text-gray-800 border-gray-200'
        };
    }
    
    public function formatCurrency($amount)
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
    
    public function formatDate($date)
    {
        return \Carbon\Carbon::parse($date)->format('d M Y, H:i');
    }
    
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.transaksi');
    }
}