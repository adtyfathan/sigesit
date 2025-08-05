<?php

namespace App\Livewire\Layanan;

use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\Produk;
use Livewire\Component;
use App\Models\Stasiun;
use App\Models\Transaksi;
use Carbon\Carbon;

class Show extends Component
{
    public $produk;
    public $showFullDescription = false;
    public $activeTab = 'overview';
    public $stasiuns;
    public $stasiun_id;
    public $waktu_awal_pemesanan;
    public $waktu_akhir_pemesanan;

    public function mount($produkId)
    {
        if (!Auth::check() || Auth::user()->role_id != 1) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $this->produk = Produk::with('kategori')->find($produkId);
        
        if (!$this->produk) {
            abort(404, 'Produk tidak ditemukan.');
        }

        $this->stasiuns = Stasiun::get();
    }

    public function toggleDescription()
    {
        $this->showFullDescription = !$this->showFullDescription;
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function formatPrice($price)
    {
        return 'Rp ' . number_format($price, 0, ',', '.');
    }

    public function copyLink()
    {
        $this->dispatch('link-copied');
    }

    public function goToCheckout()
    {
        $validated = $this->validate([
            'waktu_awal_pemesanan' => 'required|date',
            'waktu_akhir_pemesanan' => 'required|date',
            'stasiun_id' => 'required|exists:stasiun,id'
        ]);

        $start = Carbon::parse($this->waktu_awal_pemesanan);
        $end = Carbon::parse($this->waktu_akhir_pemesanan);

        if ($start->greaterThanOrEqualTo($end)) {
            $this->dispatch('error', message: 'Waktu akhir harus setelah waktu awal.');
            return;
        }

        $jam = $start->diffInHours($end);
        $hargaPerJam = $this->produk->harga_per_jam;
        $totalHarga = $jam * $hargaPerJam;

        $transaksi = Transaksi::create([
            'total_harga' => $totalHarga,
            'tanggal_transaksi' => now(),
            'waktu_awal_pemesanan' => $validated['waktu_awal_pemesanan'],
            'waktu_akhir_pemesanan' => $validated['waktu_akhir_pemesanan'],
            'status' => 'pending',
            'user_id' => Auth::user()->id,
            'produk_id' => $this->produk->id,
            'stasiun_id' => $validated['stasiun_id'],
        ]);

        $this->redirect(route('checkout', $transaksi->id), true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.layanan.show');
    }
}