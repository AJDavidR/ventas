<?php

namespace App\Livewire\Sale;

use App\Models\Product;
use App\Models\Sale;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Ventas')]
class SaleList extends Component
{
    use WithPagination;

    // propiedades clase
    public $search = '';
    public $totalRegistros = 0;
    public $cant = 5;

    public $totalVentas = 0;
    public $dateInicio;
    public $dateFinal;

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

    #[On('destroySale')]
    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);

        // Restaurar el stock y borrar cada item, no incrementa
        foreach($sale->items as $item){
            Product::find($item->id)->increment('stock', $item->qty);

            $item->delete();
        }
        
        $sale->delete();
        $this->dispatch('msg', 'Venta eliminada');
    }

    #[On('setDates')]
    public function setDates($fechaInicio, $fechaFinal)
    {
        // dump($fechaInicio, $fechaFinal);

        $this->dateInicio = $fechaInicio;
        $this->dateFinal = $fechaFinal;

        
    }
}
