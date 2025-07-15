<?php

namespace App\Livewire\Admin\Akun;

use App\Models\User;
use App\Models\Role;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    public $user;
    public $roles = [];
    public $role_id;

    public function mount($userId){
        if (!Auth::check() || Auth::user()->role_id != 2) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $this->user = User::find($userId);

        $this->role_id = $this->user->role_id;

        $this->roles = Role::get();
    }   

    public function update(){
        $validated = $this->validate([
            'role_id' => 'required|exists:role,id'
        ]);

        $this->user->update([
            'role_id' => $validated['role_id']
        ]);

        session()->flash('success', 'Role akun berhasil diedit.');
        return $this->redirect(route('admin.akun.index'), navigate: true);
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.akun.edit');
    }
}