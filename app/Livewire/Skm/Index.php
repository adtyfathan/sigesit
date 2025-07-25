<?php

namespace App\Livewire\Skm;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\Skm;
use Carbon\Carbon;

class Index extends Component
{
    public $skmDatas;

    public function mount()
    {
        if (!Auth::check() || Auth::user()->role_id != 1) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $this->skmDatas = Skm::with(['user', 'transaksi'])
            ->orderBy('tanggal_survey', 'desc')
            ->get();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.skm.index');
    }
}