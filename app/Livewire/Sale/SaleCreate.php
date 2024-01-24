<?php

namespace App\Livewire\Sale;

use App\Models\Item;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
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

    // ----------> propiedades pago
    public $pago = 0;

    public $devuelve = 0;

    public $updating = 0;

    public $client = 1;


    public function render()
    {

        $this->totalRegistros = Product::count();

        if ($this->updating == 0) {
            $this->pago = Cart::getTotal();
            $this->devuelve = $this->pago - Cart::getTotal();
        }

        return view('livewire.sale.sale-create', [
            'products' => $this->products,
            'cart' => Cart::getCart(),
            'total' => Cart::getTotal(),
            'totalArticulos' => Cart::totalArticulos(),
        ]);
    }

    // Crear venta
    public function createSale()
    {
        $cart = Cart::getCart();

        // Verificar si el carrito esta vacio
        if (count($cart) == 0) {
            // danger es el para el color del mensaje
            $this->dispatch('msg', 'No hay productos', 'danger');
            return;
        }

        // Ajustar el pago si es menor que el total
        if ($this->pago < Cart::getTotal()) {
            $this->pago = Cart::getTotal();
            $this->devuelve = 0;
        }

        // Iniciar una transaccion en base de datos
        DB::transaction(function () {
            $sale = new Sale();
            $sale->total = Cart::getTotal();
            $sale->pago = $this->pago;
            $sale->fecha = date('Y-m-d');
            $sale->client_id = $this->client;
            $sale->user_id = userID();
            $sale->save();

            // global $cart;
            // dump(\Cart::session(userID())->getContent());

            // Agregar items a la venta
            foreach (\Cart::session(userID())->getContent() as $product) {
                $item = new Item;
                $item->name = $product->name;
                $item->image = $product->associatedModel->imagen;
                $item->price = $product->price;
                $item->qty = $product->quantity;
                $item->fecha = date('Y-m-d');
                $item->product_id = $product->id;
                $item->save();

                // añadir a la tabla intermedia
                $sale->items()->attach($item->id, [
                    'qty' => $product->quantity,
                    'fecha' => date('Y-m-d'),
                ]);

                // Buscar el producto y restar del stock la cantidad vendida
                Product::find($product->id)->decrement('stock', $product->quantity);
            }

            // Limpiar
            $this->clear();

            $this->dispatch('msg', 'Venta creada correctamente');
        });

    }

    // recibir el id del cliente
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
        $this->devuelve = (int)$this->pago - Cart::getTotal();
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

    // Cancelar venta
    public function cancel()
    {
        $this->clear();
        $this->dispatch('msg', 'Venta cancelada');
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
}
