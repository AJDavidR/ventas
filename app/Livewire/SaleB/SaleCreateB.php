<?php

namespace App\Livewire\SaleB;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use Darryldecode\Cart\CartConditionCollection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

#[Title('Ventas alternativas')]
class SaleCreateB extends Component
{
    use WithFileUploads, WithPagination;

    // ----------> propiedades clase
    public $search = '';

    public $totalRegistros = 0;

    public $cant = 10;

    // ----------> propiedades pago
    public $pago = 0;

    public $devuelve = 0;

    public $updating = 0;

    public $categories;

    public $categoryBtn;

    public $selectedCategoryId = '';

    public $client;

    public function render()
    {

        $this->totalRegistros = Sale::count();
        $this->categories = Category::all();

        if ($this->updating == 0) {
            $this->pago = Cart::getTotal();
            $this->devuelve = $this->pago - Cart::getTotal();
        }

        return view('livewire.sale-b.sale-create-b', [
            'products' => $this->products,
            'cart' => Cart::getCart(),
            'subTotal' => Cart::getSubTotal(),
            'total' => Cart::getTotal(),
            'totalArticulos' => Cart::totalArticulos(),
        ]);
    }

    // obtener id de cliente
    #[On('client_id')]
    public function client_id($id = 1)
    {
        $this->client = $id;
    }

    // Actualizar el pago  y su devuelta  / mediante set-pago mandar el valor del boton de currency
    #[On('set-pago')]
    public function updatingPago($value)
    {
        $this->updating = 1;
        $this->pago = $value;
        $this->devuelve = (int) $this->pago - Cart::getTotal();
    }

    public function mount()
    {
        // limpiar el carrito al iniciar el render
        $this->clear();
    }

    // Agregar producto al carrito
    #[On('add-product')]
    public function addProduct(Product $product)
    {

        // $itemCondition1 = new \Darryldecode\Cart\CartCondition(array(
        //     'name' => 'SALE 5%',
        //     'type' => 'sale',
        //     'value' => '-5%',
        // ));
        // $itemCondition2 = new CartConditionCollection(array(
        //     'name' => 'Item Gift Pack 25.00',
        //     'type' => 'promo',
        //     'value' => '-25',
        // ));
        // $itemCondition3 = new \Darryldecode\Cart\CartCondition(array(
        //     'name' => 'MISC',
        //     'type' => 'misc',
        //     'value' => '+10',
        // ));

        // $product = array(
        //     'id' => $product->id,
        //     'name' => $product->name,
        //     'price' => $product->precio_venta,
        //     'quantity' => $product->qty,
        //     'attributes' => array(),
        //     'conditions' => [$itemCondition1, $itemCondition2, $itemCondition3]
        // );
        // $conditions = [$itemCondition1, $itemCondition2, $itemCondition3];

        Cart::add($product);

        $this->updating = 0;
    }

    // Decrementar cantidad del carrito / aumentar el stock en productRow
    public function decrement($id)
    {
        Cart::decrements($id);

        $this->dispatch("incrementStock.{$id}");

        $this->updating = 0;
    }

    // Incrementar cantidad del carrito / disminuir el stock en productRow
    public function increment($id)
    {
        Cart::increments($id);

        $this->dispatch("decrementStock.{$id}");

        $this->updating = 0;
    }

    // Eliminar item del carrito
    public function removeItem($id, $qty)
    {
        Cart::removeItem($id);
        $this->dispatch("devolverStock.{$id}", $qty);
    }

    // public function subTotal()
    // {
    //     $subTotal = Cart::getSubTotal();
    //     $this->subTotal = $subTotal;
    // }

    // Cancelar venta
    public function cancel()
    {
        $this->clear();
        $this->dispatch('msg', 'Venta cancelada');
    }

    // Limpiar venta
    public function clear()
    {
        $this->pago = 0;
        $this->devuelve = 0;
        $this->updating = 0;

        Cart::clear();

        // reiniciar stock en productRow ↓↓↓
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

    // Método para actualizar la categoría seleccionada y cargar los productos asociados
    public function selectCategory($categoryId)
    {
        $this->selectedCategoryId = $categoryId;
        $this->search = '';
        $this->products = Product::query()
            ->where('category_id', '=', $this->selectedCategoryId)
            ->orderby('id', 'desc')
            ->paginate($this->cant);
    }

    public function resetCategory()
    {
        $this->search = '';
        $this->products();
    }
}
