<?php

namespace App\Livewire\Product;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Productos')]
class ProductComponent extends Component
{
    public function render()
    {
        return view('livewire.product.product-component');
    }
}
