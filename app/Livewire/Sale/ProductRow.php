<?php

namespace App\Livewire\Sale;

use App\Models\Product;
use Livewire\Component;

class ProductRow extends Component
{
    public Product $product;
    public function render()
    {
        return view('livewire.sale.product-row');
    }

        // Agregar producto al carrito
        public function addProduct(Product $product)
        {
            $this->dispatch('add-product', $product );
        }
}
