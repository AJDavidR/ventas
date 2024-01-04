<?php

namespace App\Livewire\Category;

use App\Models\Category;
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
    public $name;

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
    // Crear la categoria
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

        $this->reset(['name']);
    }
}
