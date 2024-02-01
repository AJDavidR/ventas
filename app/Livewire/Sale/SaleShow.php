<?php

namespace App\Livewire\Sale;

use App\Models\Sale;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Detalles de venta')]
class SaleShow extends Component
{
    public Sale $sale;

    public function render()
    {
        return view('livewire.sale.sale-show');
    }
}