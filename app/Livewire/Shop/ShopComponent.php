<?php

namespace App\Livewire\Shop;

use App\Models\Shop;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

#[Title('Tienda')]
class ShopComponent extends Component
{
    use WithFileUploads, WithPagination;

    // ----------> propiedades clase
    public $search = '';

    public $totalRegistros = 0;

    public $cant = 5;

    // ----------> propiedades modelo
    public $Id = 0;

    public $name;

    public $slogan;

    public $telefono;

    public $email;

    public $direccion;

    public $ciudad;

    public $image;

    public $imageModel;

    public function render()
    {
        $this->totalRegistros = Shop::count();

        $shops = Shop::query()
            ->where('name', 'like', "%{$this->search}%")
            ->orderby('id', 'desc')
            // ->sortBy('id', 'desc')
            ->paginate($this->cant);

        return view('livewire.shop.shop-component', [
            'shops' => $shops,
        ]);
    }

    // resetear campos
    public function resetInputFields()
    {
        $this->reset([
            'name',
            'slogan',
            'telefono',
            'email',
            'direccion',
            'ciudad',
            'image',
            'imageModel',
        ]);
        $this->resetErrorBag();
    }

    // Crear la tienda
    public function create()
    {
        $this->Id = 0;
        $this->resetInputFields();
        $this->dispatch('open-modal', 'modalShop');
    }

    // guardar el nueva tienda
    public function store()
    {
        // dump('Crear shop');
        $rules = [
            'name' => 'required|min:5|max:255|unique:shops',
            'slogan' => 'max:255|nullable',
            'telefono' => 'numeric|nullable',
            'email' => 'max:255|nullable|Email',
            'direccion' => 'max:255|nullable',
            'ciudad' => 'max:255|nullable',
            'image' => 'image|max:1024|nullable',
        ];
        $this->validate($rules);

        $shop = new Shop();

        $shop->name = $this->name;
        $shop->slogan = $this->slogan;
        $shop->telefono = $this->telefono;
        $shop->email = $this->email;
        $shop->direccion = $this->direccion;
        $shop->ciudad = $this->ciudad;

        $shop->save();

        if ($this->image) {
            $newName = 'shops/' . uniqid() . '.' . $this->image->extension();
            $this->image->storeAs('public', $newName);
            $shop->image()->create(['url' => $newName]);
        }

        $this->dispatch('close-modal', 'modalShop');
        $this->dispatch('msg', 'tienda creado correctamente');

        $this->resetInputFields();
    }

    // Editar tienda
    public function edit(Shop $shop)
    {
        $this->resetInputFields();

        $this->Id = $shop->id;
        $this->name = $shop->name;
        $this->slogan = $shop->slogan;
        $this->telefono = $shop->telefono;
        $this->email = $shop->email;
        $this->direccion = $shop->direccion;
        $this->ciudad = $shop->ciudad;

        $this->dispatch('open-modal', 'modalShop');
    }

    // Actualizar el tienda
    public function update(Shop $shop)
    {
        // dump($shop);
        $rules = [
            'name' => 'required|min:5|max:255|unique:shops,'.$this->Id,
            'slogan' => 'max:255|nullable',
            'telefono' => 'numeric|nullable',
            'email' => 'max:255|nullable|Email',
            'direccion' => 'max:255|nullable',
            'ciudad' => 'max:255|nullable',
            'image' => 'image|max:1024|nullable',
        ];
        $this->validate($rules);

        $shop->name = $this->name;
        $shop->slogan = $this->slogan;
        $shop->telefono = $this->telefono;
        $shop->email = $this->email;
        $shop->direccion = $this->direccion;
        $shop->ciudad = $this->ciudad;

        $shop->update();

        if ($this->image) {
            if ($shop->image != null) {
                Storage::delete('public/' . $shop->image->url);
                $shop->image()->delete();
            }
            $newName = 'shops/' . uniqid() . '.' . $this->image->extension();
            $this->image->storeAs('public', $newName);
            $shop->image()->create(['url' => $newName]);
        }

        $this->dispatch('close-modal', 'modalShop');
        $this->dispatch('msg', 'Tienda editado correctamente');

        $this->resetInputFields();
    }

    // eliminar tienda
    #[On('destroyShop')]
    public function destroy($id)
    {
        // dump($id);
        $shop = Shop::findOrFail($id);
        $shop->delete();

        if ($shop->image != null) {
            Storage::delete('public/' . $shop->image->url);
            $shop->image()->delete();
        }

        $this->dispatch('msg', 'Tienda eliminado correctamente');
    }
}
