<?php

namespace App\Livewire\Client;

use App\Models\Client;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

#[Title('Clientes')]
class ClientComponent extends Component
{
    use WithFileUploads, WithPagination;

    // ----------> propiedades clase
    public $search = '';

    public $totalRegistros = 0;

    public $cant = 5;

    // ----------> propiedades modelo
    public $Id = 0;

    public $name;

    public $identificacion;

    public $telefono;

    public $email;

    public $empresa;

    public $nit;

    public function render()
    {
        $this->totalRegistros = Client::count();

        $clients = Client::query()
            ->where('name', 'like', "%{$this->search}%")
            ->orderby('id', 'desc')
            ->paginate($this->cant);

        return view('livewire.client.client-component', [
            'clients' => $clients,
        ]);
    }

    // resetear campos
    public function resetInputFields()
    {
        $this->reset([
            'name',
            'identificacion',
            'telefono',
            'email',
            'empresa',
            'nit',
        ]);
        $this->resetErrorBag();
    }

    // Crear el cliente
    public function create()
    {
        $this->Id = 0;
        $this->resetInputFields();
        $this->dispatch('open-modal', 'modalClient');
    }

    // guardar el nuevo Cliente
    public function store()
    {
        $rules = [
            'name' => 'required|min:5|max:255',
            // 'identificacion' => 'required|max:999999999999999|unique:clients|numeric',
            // ^: Indica que la cadena debe comenzar aquí. // [0-9]: Representa cualquier dígito del 0 al 9.
            // {6,10}: Indica que debe haber de 6 a 10 dígitos. // $: Indica que la cadena debe terminar aquí.
            'identificacion' => 'required|regex:/^[0-9]{6,10}$/|numeric|unique:clients',
            'telefono' => 'numeric|nullable',
            'email' => 'nullable|Email|max:255',
            'empresa' => 'nullable',
            'nit' => 'numeric|nullable',
        ];
        $messages = [
            'identificacion.regex' => 'El campo de identificación debe contener solo números y tener entre 6 y 10 dígitos.',
        ];

        $this->validate($rules, $messages);

        $client = new Client();

        $client->name = $this->name;
        $client->identificacion = $this->identificacion;
        $client->telefono = $this->telefono;
        $client->email = $this->email;
        $client->empresa = $this->empresa;
        $client->nit = $this->nit;

        $client->save();

        $this->dispatch('close-modal', 'modalClient');
        $this->dispatch('msg', 'Cliente creado correctamente');

        $this->resetInputFields();
    }

    // editar el Cliente
    public function edit(Client $client)
    {
        $this->resetInputFields();
        $this->Id = $client->id;
        $this->name = $client->name;
        $this->identificacion = $client->identificacion;
        $this->telefono = $client->telefono;
        $this->email = $client->email;
        $this->empresa = $client->empresa;
        $this->nit = $client->nit;
        $this->dispatch('open-modal', 'modalClient');
    }

    // Actualizar el Cliente
    public function update(Client $client)
    {
        $rules = [
            'name' => 'required|min:5|max:255',
            'identificacion' => 'required|regex:/^[0-9]{6,10}$/|numeric|unique:clients,id,'.$this->Id,
            'telefono' => 'numeric|nullable',
            'email' => 'nullable|Email|max:255',
            'empresa' => 'nullable',
            'nit' => 'numeric|nullable',
        ];
        $messages = [
            'identificacion.regex' => 'El campo de identificación debe contener solo números y tener entre 6 y 10 dígitos.',
        ];

        $this->validate($rules, $messages);
        $client->name = $this->name;
        $client->identificacion = $this->identificacion;
        $client->telefono = $this->telefono;
        $client->email = $this->email;
        $client->empresa = $this->empresa;
        $client->nit = $this->nit;
        $client->update();

        $this->dispatch('close-modal', 'modalClient');
        $this->dispatch('msg', 'Cliente editado correctamente');

        $this->resetInputFields();
    }

    // eliminar cliente
    #[On('destroyClient')]
    public function destroy($id)
    {
        // dump($id);
        $category = Client::findOrFail($id);
        $category->delete();
        $this->dispatch('msg', 'Cliente eliminado correctamente');
    }
}
