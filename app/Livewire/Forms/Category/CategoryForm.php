<?php

namespace App\Livewire\Forms\Category;

use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CategoryForm extends Form
{
    // #[Validate('required', message: 'El nombre es requerido')]
    // #[Validate('min:5', message: 'El nombre debe tener minimo 5 caracteres')]
    // #[Validate('max:255', message: 'El nombre no debe superar los 255 caracteres')]
    // #[Validate('unique:categories', message: 'El nombre de la categoria ya esta en uso')]

    #[Validate([
        'required',
        'min:5',
        'max:255',
        'unique:categories'
    ], message: [
        'required' => 'El nombre es requerido',
        'min' => 'El nombre debe tener minimo 5 caracteres',
        'max' => 'El nombre no debe superar los 255 caracteres',
        'unique' => 'El nombre de la categoria ya esta en uso'
    ])]
    public $name = '';
    public function store()
    {
        Category::create($this->validate());
    }
    public function update(Category $category)
    {
        $category->update($this->validate());
    }
}
