<?php

namespace App\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

#[Title('Productos')]
class ProductComponent extends Component
{
    use WithFileUploads, WithPagination;

    // ----------> propiedades clase
    public $search = '';

    public $totalRegistros = 0;

    public $cant = 5;

    // ----------> propiedades modelo
    public $Id = 0;

    public $name;

    public $descripcion;

    public $precio_compra;

    public $precio_venta;

    public $stock;

    public $stock_minimo = 10;

    public $codigo_barras;

    public $fecha_vencimiento;

    public $active;

    public $category_id;

    public $image;

    public function render()
    {
        $this->totalRegistros = Product::count();

        $products = Product::query()
            ->where('name', 'like', "%{$this->search}%")
            ->orWhere('category_id', 'like', "%{$this->search}%")
            ->orWhere('active', 'like', "%{$this->search}%")
            ->orderby('id', 'desc')
            ->paginate($this->cant);

        return view('livewire.product.product-component', [
            'products' => $products,
        ]);
    }

    // Obtener categorias
    #[Computed()]
    public function categories()
    {
        return Category::all();
    }

    // resetear campos
    public function resetInputFields()
    {
        $this->reset([
            'name',
            'descripcion',
            'precio_compra',
            'precio_venta',
            'stock',
            'stock_minimo',
            'codigo_barras',
            'fecha_vencimiento',
            'active',
            'category_id',
            'image',
        ]);
        $this->resetErrorBag();
    }

    // Crear la categoria
    public function create()
    {
        $this->Id = 0;
        $this->resetInputFields();
        $this->dispatch('open-modal', 'modalProduct');
    }

    // guardar el nuevo producto
    public function store()
    {
        // dump('Crear category');
        $rules = [
            'name' => 'required|min:5|max:255|unique:products',
            'descripcion' => 'max:255',
            'precio_compra' => 'numeric|nullable',
            'precio_venta' => 'required|numeric',
            'stock' => 'required|numeric',
            'stock_minimo' => 'numeric|nullable',
            'image' => 'image|max:1024|nullable',
            'category_id' => 'required|numeric',

        ];
        $this->validate($rules);

        $product = new Product();

        $product->name = $this->name;
        $product->descripcion = $this->descripcion;
        $product->precio_compra = $this->precio_compra;
        $product->precio_venta = $this->precio_venta;
        $product->stock = $this->stock;
        $product->stock_minimo = $this->stock_minimo;
        $product->codigo_barras = $this->codigo_barras;
        $product->fecha_vencimiento = $this->fecha_vencimiento;
        $product->category_id = $this->category_id;
        $product->active = $this->active;

        $product->save();

        if ($this->image) {
            $newName = 'product/'.uniqid().'.'.$this->image->extension();
            $this->image->storeAs('public', $newName);
            $product->image()->create(['url' => $newName]);
        }

        $this->dispatch('close-modal', 'modalProduct');
        $this->dispatch('msg', 'Producto creado correctamente');

        $this->resetInputFields();
    }

    // Editar el producto
    public function edit(Product $product)
    {
        $this->resetInputFields();

        $this->Id = $product->id;
        $this->name = $product->name;
        $this->descripcion = $product->descripcion;
        $this->precio_compra = $product->precio_compra;
        $this->precio_venta = $product->precio_venta;
        $this->stock = $product->stock;
        $this->stock_minimo = $product->stock_minimo;
        $this->codigo_barras = $product->codigo_barras;
        $this->fecha_vencimiento = $product->fecha_vencimiento;
        $this->category_id = $product->category_id;
        $this->active = $product->active;

        $this->dispatch('open-modal', 'modalProduct');
    }

    // Actualizar el producto
    public function update(Product $product)
    {
        // dump($product);
        $rules = [
            'name' => 'required|min:5|max:255|unique:products,'.$this->Id,
            'descripcion' => 'max:255',
            'precio_compra' => 'numeric|nullable',
            'precio_venta' => 'required|numeric',
            'stock' => 'required|numeric',
            'stock_minimo' => 'numeric|nullable',
            'image' => 'image|max:1024|nullable',
            'category_id' => 'required|numeric',

        ];
        $this->validate($rules);

        $product->name = $this->name;
        $product->descripcion = $this->descripcion;
        $product->precio_compra = $this->precio_compra;
        $product->precio_venta = $this->precio_venta;
        $product->stock = $this->stock;
        $product->stock_minimo = $this->stock_minimo;
        $product->codigo_barras = $this->codigo_barras;
        $product->fecha_vencimiento = $this->fecha_vencimiento;
        $product->category_id = $this->category_id;
        $product->active = $this->active;
        // $product->imageModel = $this->image;

        $product->update();

        if ($this->image) {
            if ($product->image != null) {
                Storage::delete('public/'.$product->image->url);
                $product->image()->delete();
            }
            $newName = 'product/'.uniqid().'.'.$this->image->extension();
            $this->image->storeAs('public', $newName);
            $product->image()->create(['url' => $newName]);
        }

        $this->dispatch('close-modal', 'modalProduct');
        $this->dispatch('msg', 'Producto editado correctamente');

        // $this->resetInputFields();
    }

    // eliminar producto
    #[On('destroyProduct')]
    public function destroy($id)
    {
        // dump($id);
        $product = Product::findOrFail($id);
        $product->delete();

        if ($product->image != null) {
            Storage::delete('public/'.$product->image->url);
            $product->image()->delete();
        }

        $this->dispatch('msg', 'Producto eliminado correctamente');
    }
}
