<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Categorias')]

class CategoryComponent extends Component
{
    use WithPagination;
    // propiedades clase
    public $search = '', $totalRegistros = 0, $cant = 5;
    // propiedades modelo
    public $name, $Id;
    public function render()
    {
        $this->totalRegistros = Category::count();

        $categories = Category::query()
            ->where('name', 'like', "%{$this->search}%")
            ->orderby('id', 'desc')
            ->paginate($this->cant);
        // $categories = collect(); 


        return view('livewire.category.category-component', [
            'categories' => $categories
        ]);
    }

    public function mount()
    {
    }
    public function resetInputFields()
    {
        $this->reset([
            'name',
        ]);
        $this->resetErrorBag();
    }
    // Crear la categoria
    public function create()
    {
        $this->Id = 0;
        $this->resetInputFields();
        $this->dispatch('open-modal', 'modalCategory');
    }
    // guardar la nueva categoria
    public function store()
    {
        // dump('Crear category');
        $rules = [
            'name' => 'required|min:5|max:255|unique:categories'
        ];
        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.min' => 'El nombre debe tener minimo 5 caracteres',
            'name.max' => 'El nombre no debe superar los 255 caracteres',
            'name.unique' => 'El nombre de la categoria ya esta en uso',
        ];
        $this->validate($rules, $messages);

        $category = new Category;

        $category->name = $this->name;

        $category->save();

        $this->dispatch('close-modal', 'modalCategory');
        $this->dispatch('msg', 'Categoria creada correctamente');

        $this->resetInputFields();
    }

    // editar la categoria
    public function edit(Category $category)
    {
        $this->resetInputFields();
        $this->Id = $category->id;
        $this->name = $category->name;
        $this->dispatch('open-modal', 'modalCategory');
    }
    // Actualizar la categoria
    public function update(Category $category)
    {
        // dump($category);
        $rules = [
            'name' => 'required|min:5|max:255|unique:categories,id,' . $this->Id
        ];
        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.min' => 'El nombre debe tener minimo 5 caracteres',
            'name.max' => 'El nombre no debe superar los 255 caracteres',
            'name.unique' => 'El nombre de la categoria ya esta en uso',
        ];
        $this->validate($rules, $messages);
        $category->name = $this->name;
        $category->update();

        $this->dispatch('close-modal', 'modalCategory');
        $this->dispatch('msg', 'Categoria editada correctamente');

        $this->resetInputFields();
    }
    // eliminar categoria
    #[On('destroyCategory')]
    public function destroy($id)
    {
        // dump($id);
        $category = Category::findOrFail($id);
        $category->delete();
        $this->dispatch('msg', 'Categoria eliminada correctamente');
    }
}
