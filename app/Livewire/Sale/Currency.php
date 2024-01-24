<?php

namespace App\Livewire\Sale;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class Currency extends Component
{
    // Reactive es para que total se actualize automaticamente
    #[Reactive]
    public $total;

    public $valores = [];

    public function render()
    {
        return view('livewire.sale.currency');
    }

    public function mount()
    {
        $this->valores = [
            1000, 2000, 5000, 10000, 20000, 50000, 100000,
        ];
    }

    // Abrir modal del boton de pago
    public function openModal()
    {
        $this->dispatch('open-modal', 'modalCurrency');
    }

    // cerrar modal del boton de pago
    public function closeModal()
    {
        $this->dispatch('close-modal', 'modalCurrency');
    }

    // setear pago
    public function setPago($valor)
    {
        $this->dispatch('set-pago', $valor);
        $this->closeModal();
    }
}
