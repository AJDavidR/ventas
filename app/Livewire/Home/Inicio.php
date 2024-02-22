<?php

namespace App\Livewire\Home;

use App\Models\Category;
use App\Models\Client;
use App\Models\Item;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
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

    // cajas reportes fila1
    public $cantidadVentas = 0;
    public $totalVentas = 0;
    public $cantidadArticulos = 0;
    public $cantidadProductos = 0;

    // cajas reportes fila2

    public $cantidadProducts = 0;
    public $cantidadStock = 0;
    public $cantidadCategories = 0;
    public $cantidadClients = 0;

    // tablas de reportes 

    public $productosMasVendidosHoy;
    public $productosMasVendidosMes;
    public $productosMasVendidos;
    public $productosRecientes;


    public function render()
    {
        $this->salesToday();
        $this->calVentasMes();
        $this->boxes_reports();
        $this->set_products_reports();

        return view('livewire.home.inicio');
    }

    // Cargar propiedades de productos mas vendidos
    public function set_products_reports()
    {
        $this->productosMasVendidosHoy = $this->products_reports(1);
        $this->productosMasVendidosMes = $this->products_reports(0, 1);
        $this->productosMasVendidos = $this->products_reports();
        $this->productosRecientes = Product::take(5)->orderBy('id', 'desc')->get();

    }

    public function products_reports($filtrarDia=0, $filtrarMes=0)
    {
        $productsQuery = Item::select('items.id', 'items.name', 'items.price', 'items.image', 'items.product_id', DB::raw('SUM(items.qty) as total_quantity'))->groupBy('product_id')->whereYear('items.fecha', date('Y'));

        if ($filtrarDia) {
            $productsQuery = $productsQuery->whereDate('items.fecha', date('Y-m-d'));
        }
        if ($filtrarMes) {
            $productsQuery = $productsQuery->whereMonth('items.fecha', date('m'));
        }

        $productsQuery = $productsQuery->orderBy('total_quantity', 'desc')
                                        ->take(5)
                                        ->get();
        return $productsQuery;
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
