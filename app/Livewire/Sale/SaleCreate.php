<?php

namespace App\Livewire\Sale;

use App\Models\Product;
use App\Models\Cart;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

#[Title('Ventas')]
class SaleCreate extends Component
{
    use WithFileUploads, WithPagination;

    // ----------> propiedades clase
    public $search = '';

    public $totalRegistros = 0;

    public $cant = 5;

    // ----------> propiedades modelo
    public $Id = 0;

    public function render()
    {

        $this->totalRegistros = Product::count();



        return view('livewire.sale.sale-create', [
            'products' => $this->products,
            'cart' => Cart::getCart(),
            'total' => Cart::getTotal(),
        ]);
    }

    // Agregar producto al carrito
    public function addProduct(Product $product)
    {
        // dump($product);
        Cart::add($product);
    }

    // Decrementar cantidad del carrito
    public function decrement($id)
    {
        // dump($product);
        Cart::decrements($id);
    }

    // Incrementar cantidad del carrito
    public function increment($id)
    {
        // dump($product);
        Cart::increments($id);
    }

    // Eliminar item del carrito
    public function removeItem($id)
    {
        // dump($product);
        Cart::removeItem($id);
    }

    // propiedad para obtener el listado de productos
    #[Computed]
    public function products()
    {
        return Product::query()
            ->where('name', 'like', "%{$this->search}%")
            ->orderby('id', 'desc')
            ->paginate($this->cant);
    }
}
