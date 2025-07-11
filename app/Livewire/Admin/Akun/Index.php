<?php

namespace App\Livewire\Admin\Akun;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Index extends Component
{
    public $users = [];

    public function mount(){
        if (!Auth::check() || Auth::user()->role_id != 2) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $this->users = User::with('role')
            ->where('role_id', '!=', 2)
            ->get();
    }   

    public function delete($userId){
        User::find($userId)->delete();

        session()->flash('message', 'Akun berhasil dihapus.');

        return $this->redirect(route('admin.akun.index'), navigate: true);
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.akun.index');
    }
}