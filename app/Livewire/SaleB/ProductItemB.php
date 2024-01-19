<?php

namespace App\Livewire\SaleB;

use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductItemB extends Component
{
    public Product $product;
    public $stock;
    public $stockLabel;

    protected function getListeners()
    {
        return [
            "decrementStock.{$this->product->id}" => "decrementStock",
            "incrementStock.{$this->product->id}" => "incrementStock",
            "refreshProduct" => "mount",
            "devolverStock.{$this->product->id}" => "devolverStock",
        ];
    }
    public function render()
    {
        return view('livewire.sale-b.product-item-b');
    }
    public function mount()
    {
        // reiniciar stock
        $this->stock = $this->product->stock;
    }

    // Agregar producto al carrito
    public function addProduct(Product $product)
    {
        if ($this->stock == 0) {
            return;
        }
        $this->dispatch('add-product', $product);
        $this->stock--;
    }

    // escuchar decrementStock para disminuir el stock listado
    #[On('decrementStock')]
    public function decrementStock()
    {
        $this->stock--;
    }

    // escuchar incrementStock para aumentar el stock listado
    #[On('incrementStock')]
    public function incrementStock()
    {
        if ($this->stock == $this->product->stock - 1) {
            return;
        }
        $this->stock++;
    }

    // escuchar devolverStock para devolver los articulos a el stock listado
    #[On('devolverStock')]
    public function devolverStock($qty)
    {
        $this->stock = $this->stock + $qty;
    }

    // añadir badge color a stock dependiendo de stock minimo
    public function stockLabel()
    {
        if ($this->stock <= $this->product->stock_minimo) {
            return '<span class="badge badge-pill badge-danger">' . $this->stock . '</span>';
        } else {
            return '<span class="badge badge-pill badge-success">' . $this->stock . '</span>';
        }
    }
}
