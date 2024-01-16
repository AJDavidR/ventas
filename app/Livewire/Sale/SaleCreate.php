<?php

namespace App\Livewire\Sale;

use App\Models\Product;
use App\Models\Cart;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
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
            'totalArticulos' => Cart::totalArticulos(),
        ]);
    }

    public function mount()
    {
        // limpiar el carrito al iniciar el render
        // $this->clear();
    }

    // Agregar producto al carrito
    #[On('add-product')]
    public function addProduct(Product $product)
    {
        Cart::add($product);
    }
    
    // Decrementar cantidad del carrito / aumentar el stock en productRow
    public function decrement($id)
    {
        Cart::decrements($id);

        $this->dispatch("incrementStock.{$id}");
    }
    
    // Incrementar cantidad del carrito / disminuir el stock en productRow
    public function increment($id)
    {
        Cart::increments($id);

        $this->dispatch("decrementStock.{$id}");
    }

    // Eliminar item del carrito
    public function removeItem($id)
    {
        Cart::removeItem($id);
    }

    // Cancelar venta
    public function clear()
    {
        Cart::clear();
        $this->dispatch('msg', 'Venta cancelada');
        $this->dispatch('refreshProduct');
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
