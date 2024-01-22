<?php
// lo mejor es poner los metodos de clientComponent en un trait para reutilizarlos aqui y en clientComponent sin duplicar codigo

namespace App\Livewire\Sale;

use App\Models\Client as Cliente;
use Livewire\Attributes\On;
use Livewire\Component;

class Client extends Component
{
    // ----------> propiedades modelo

    public $Id = 0;

    public $name;

    public $identificacion;

    public $telefono;

    public $email;

    public $empresa;

    public $nit;

    public $client = 1;

    public $nameClient;

    public function render()
    {
        return view('livewire.sale.client', [
            'clients' => Cliente::all()
        ]);
    }

    #[On('client_id')]
    public function client_id($id=1){
        $this->client = $id;
        $this->nameClient($id);
    }

    public function mount(){
        $this->nameClient();
    }

    // nombre del cliente
    public function nameClient($id=1){
        $findClient = Cliente::find($id);
        $this->nameClient = $findClient->name;
    }

    // Abrir modal de clientes
    public function openModal()
    {
        $this->Id = 0;
        // $this->resetInputFields();
        $this->dispatch('open-modal', 'modalClient');
    }

    // guardar el nuevo Cliente
    public function store()
    {
        $rules = [
            'name' => 'required|min:5|max:255',
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

        $client = new Cliente();

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
}
