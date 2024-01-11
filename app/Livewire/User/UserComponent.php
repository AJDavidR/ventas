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
            're_password',
            'admin',
            'active',
            'image',
            'imageModel',
        ]);
        $this->image = '';
        $this->resetErrorBag();
    }

    // Crear el usuario
    public function create()
    {
        $this->Id = 0;
        $this->resetInputFields();
        $this->dispatch('open-modal', 'modalUser');
    }

    // guardar el nuevo Usuario
    public function store()
    {
        $rules = [
            'name' => 'required|min:5|max:255',
            'email' => 'required|Email|max:255|unique:users',
            'password' => 'required|min:5',
            're_password' => 'required|same:password',
            'image' => 'image|max:1024|nullable',

        ];
        $this->validate($rules);

        $User = new User();

        $User->name = $this->name;
        $User->email = $this->email;
        $User->password = bcrypt($this->password);
        $User->admin = $this->admin;
        $User->active = $this->active;

        $User->save();

        if ($this->image) {
            $newName = 'users/' . uniqid() . '.' . $this->image->extension();
            $this->image->storeAs('public', $newName);
            $User->image()->create(['url' => $newName]);
        }

        $this->dispatch('close-modal', 'modalUser');
        $this->dispatch('msg', 'Usuario creado correctamente');

        $this->resetInputFields();
    }

    // Editar el usuario
    public function edit(User $user)
    {
        $this->resetInputFields();

        $this->Id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->admin = $user->admin;
        $this->active = $user->active;

        $this->dispatch('open-modal', 'modalUser');
    }
}
