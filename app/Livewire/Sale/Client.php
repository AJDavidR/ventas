<?php

namespace App\Livewire\Sale;

use App\Models\Client as Cliente;
use Livewire\Component;

class Client extends Component
{
    public $Id = 0;
    public $client;

    public function render()
    {
        return view('livewire.sale.client', [
            'clients' => Cliente::all()
        ]);
    }

    // Abrir modal de clientes
    public function openModal()
    {
        $this->Id = 0;
        // $this->resetInputFields();
        $this->dispatch('open-modal', 'modalClient');
    }
}
