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
    public  $Id = 0;
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
        $this->Id = 0;
        $this->resetInputFields();
        $this->dispatch('open-modal', 'modalCategory');
    }

    // Editar la categoria
    public function edit(Category $category)
    {
        $this->resetInputFields();
        $this->Id = $category->id;
        $this->form->name = $category->name;
        $this->dispatch('open-modal', 'modalCategory');
    }

    #[On('destroyCategory')]
    public function destroy($id)
    {
        // dump($id);
        $category = Category::findOrFail($id);
        $category->delete();
        $this->dispatch('msg', 'Categoria eliminada correctamente');
    }

    public function save(Category $category)
    {
        // formType tipo de formulario creacion o edicion
        $formType = $this->Id = $category->id;

        if ($formType !== null) {
            // dd('editar');
            $this->form->update($category);
            $this->dispatch('msg', 'Categoria editada correctamente');
        } elseif ($formType === null) {
            // dd('crear');
            $this->form->store();
            $this->dispatch('msg', 'Categoria creada correctamente');
        }
        $this->dispatch('close-modal', 'modalCategory');
        $this->resetInputFields();
    }
}
