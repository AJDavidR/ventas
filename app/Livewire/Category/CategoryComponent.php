<?php

namespace App\Livewire\Category;

use App\Livewire\Forms\Category\CategoryForm;
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
    public  $Id;
    public CategoryForm $form;
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
            'form.name',
        ]);
        $this->resetErrorBag();
    }
    // Crear la categoria
    public function create()
    {
        $this->resetInputFields();
        $this->dispatch('open-modal', 'modalCategory');
    }
    // guardar la nueva categoria
    public function store()
    {
        Category::create($this->form->validate());

        $this->dispatch('close-modal', 'modalCategory');
        $this->dispatch('msg', 'Categoria creada correctamente');

        $this->resetInputFields();
    }

    // editar la categoria
    public function edit(Category $category)
    {
        $this->resetInputFields();
        $this->Id = $category->id;
        $this->form->name = $category->name;
        $this->dispatch('open-modal', 'modalCategory');
    }
    // Actualizar la categoria
    public function update(Category $category)
    {
        $category->update($this->form->validate());

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
