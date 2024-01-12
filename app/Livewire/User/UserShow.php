<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Usuario')]
class UserShow extends Component
{
    public User $user;
    public function render()
    {
        return view('livewire.user.user-show');
    }
}
