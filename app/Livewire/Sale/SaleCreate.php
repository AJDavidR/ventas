<?php

namespace App\Livewire\Sale;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Crear venta')]
class SaleCreate extends Component
{
    public function render()
    {
        return view('livewire.sale.sale-create');
    }
}
