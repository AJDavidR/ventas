<?php

namespace App\Livewire\Category;

use Livewire\Attributes\Title;
use Livewire\Component;

class CategoryComponent extends Component
{
    #[Title('Inicio test')]
    public function render()
    {
        return view('livewire.category.category-component');
    }
}
