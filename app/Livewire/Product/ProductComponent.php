<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Productos')]
class ProductComponent extends Component
{
    use WithPagination;
    // ----------> propiedades clase
    public $search = '';
    public $totalRegistros = 0;
    public $cant = 5;
    // ----------> propiedades modelo
    public $name;
    public $descripcion;
    public $precio_compra;
    public $precio_venta;
    public $stock;
    public $stock_minimo;
    public $codigo_barras;
    public $fecha_vencimiento;
    public $active;
    public $category_id;
    public  $Id;

    public function render()
    {
        $this->totalRegistros = Product::count();

        $products = Product::query()
            ->where('name', 'like', "%{$this->search}%")
            ->orderby('id', 'desc')
            ->paginate($this->cant);

        return view('livewire.product.product-component', [
            'products' => $products
        ]);
    }
}
