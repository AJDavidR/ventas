<?php

namespace App\Livewire\Home;

use App\Models\Category;
use App\Models\Client;
use App\Models\Item;
use App\Models\Product;
use App\Models\Sale;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Inicio')]
class Inicio extends Component
{
    // Ventas hoy
    public $ventasHoy = 0;
    public $totalVentasHoy = 0;
    public $articulosHoy = 0;
    public $productosHoy = 0;

    // Ventas mes grafica
    public $listTotalVentasMes = '';

    // cajas reportes
    public $cantidadVentas = 0;
    public $totalVentas = 0;
    public $cantidadArticulos = 0;
    public $cantidadProductos = 0;


    public $cantidadProducts = 0;
    public $cantidadStock = 0;
    public $cantidadCategories = 0;
    public $cantidadClients = 0;

    public function render()
    {
        $this->salesToday();
        $this->calVentasMes();
        $this->boxes_reports();

        return view('livewire.home.inicio');
    }

    public function salesToday()
    {
        $this->ventasHoy = Sale::whereDate('fecha', Date('Y-m-d'))->count();
        $this->totalVentasHoy = Sale::whereDate('fecha', Date('Y-m-d'))->sum('total');
        $this->articulosHoy = Item::whereDate('fecha', Date('Y-m-d'))->sum('qty');
        $this->productosHoy = count(Item::whereDate('fecha', Date('Y-m-d'))->groupBy('product_id')->get());
    }

    public function calVentasMes()
    {
        for ($i = 1; $i <= 12; $i++) {
            $this->listTotalVentasMes .= Sale::whereMonth('fecha', '=', $i)->sum('total') . ',';
        }
    }

    public function boxes_reports()
    {
        $this->cantidadVentas = Sale::whereYear('fecha', '=', date('Y'))->count();
        $this->totalVentas = Sale::whereYear('fecha', '=', date('Y'))->sum('total');
        $this->cantidadArticulos = Item::whereYear('fecha', '=', date('Y'))->sum('qty');
        $this->cantidadProductos = count(Item::whereYear('fecha', '=', date('Y'))->groupBy('product_id')->get());

        $this->cantidadProducts = Product::count();
        $this->cantidadStock = Product::sum('stock');
        $this->cantidadCategories = Category::count();
        $this->cantidadClients = Client::count();
    }
    
}
