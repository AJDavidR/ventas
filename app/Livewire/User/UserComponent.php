<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

#[Title('Usuarios')]
class UserComponent extends Component
{
    use WithFileUploads, WithPagination;

    // ----------> propiedades clase
    public $search = '';

    public $totalRegistros = 0;

    public $cant = 5;

    // ----------> propiedades modelo
    public $Id = 0;
    public $name;
    public $email;
    public $password;
    public $re_password;
    public $admin;
    public $active;
    public $image;
    public $imageModel;

    public function render()
    {
        $this->totalRegistros = User::count();

        $users = User::query()
            ->where('name', 'like', "%{$this->search}%")
            ->orderby('id', 'desc')
            ->paginate($this->cant);

        return view('livewire.user.user-component', [
            'users' => $users,
        ]);
    }

    // resetear campos
    public function resetInputFields()
    {
        $this->reset([
            'name',
            'email',
            'password',
            'admin',
            'active',
            'image',
            'imageModel',
        ]);
        $this->resetErrorBag();
    }

    // Crear la categoria
    public function create()
    {
        $this->Id = 0;
        $this->resetInputFields();
        $this->dispatch('open-modal', 'modalUser');
    }
}
