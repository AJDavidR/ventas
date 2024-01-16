<?php

namespace App\Livewire\Sale;

use App\Models\Product;
use Livewire\Component;

class ProductRow extends Component
{
    public Product $product;
    public $stock;
    public $stockLabel;
    public function render()
    {
        $this->stockLabel = $this->stockLabel();
        return view('livewire.sale.product-row');
    }

    public function mount()
    {
        $this->stock = $this->product->stock;
    }

    // Agregar producto al carrito
    public function addProduct(Product $product)
    {
        if($this->stock==0){
            return;
        }
        $this->dispatch('add-product', $product);
        $this->stock--;
    }

    public function stockLabel(){
        if ($this->stock<=$this->product->stock_minimo) {
            return '<span class="badge badge-pill badge-danger">'.$this->stock.'</span>';
        } else {
            return '<span class="badge badge-pill badge-success">'.$this->stock.'</span>';
        }
        
    }
}
