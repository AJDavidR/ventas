<?php

namespace App\Livewire\Home;

use Livewire\Attributes\Title;
use Livewire\Component;

class Inicio extends Component
{
    #[Title('Inicio test')]
    public function render()
    {
        return view('livewire.home.inicio');
    }
}
