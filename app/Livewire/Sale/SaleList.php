<?php

namespace App\Livewire\Sale;

use App\Models\Sale;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('Ventas')]
class SaleList extends Component
{
    use WithPagination;

        // propiedades clase
        public $search = '';

        public $totalRegistros = 0;
    
        public $cant = 5;

    public function render()
    {
        $this->totalRegistros = Sale::count();

        $sales = Sale::query()
            ->where('name', 'like', "%{$this->search}%")
            ->orderby('id', 'desc')
            ->paginate($this->cant);

        return view('livewire.sale.sale-list', [
            'sales' => $sales,
        ]);
    }
}
