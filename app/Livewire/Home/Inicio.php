<?php

namespace App\Livewire\Home;

use App\Models\Item;
use App\Models\Sale;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Inicio')]
class Inicio extends Component
{
    public $ventasHoy = 0;
    public $totalVentasHoy = 0;
    public $articulosHoy = 0;
    public $productosHoy = 0;

    public $listTotalVentasMes='';

    public function render()
    {
        $this->salesToday();
        $this->calVentasMes();

        return view('livewire.home.inicio');
    }

    public function salesToday()
    {
        $this->ventasHoy = Sale::whereDate('fecha',Date('Y-m-d'))->count();
        $this->totalVentasHoy = Sale::whereDate('fecha',Date('Y-m-d'))->sum('total');
        $this->articulosHoy = Item::whereDate('fecha',Date('Y-m-d'))->sum('qty');
        $this->productosHoy = count(Item::whereDate('fecha',Date('Y-m-d'))->groupBy('product_id')->get());
    }

    public function calVentasMes()
    {
        for ($i=1; $i <= 12; $i++) { 
            $this->listTotalVentasMes .= Sale::whereMonth('fecha', '=', $i)->sum('total'). ',';
        }
    }
}
