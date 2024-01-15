<?php

namespace App\Livewire\Client;

use App\Models\Client;
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
}