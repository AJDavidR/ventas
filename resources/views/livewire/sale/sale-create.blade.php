<div>
    <x-card cardTitle="Crear Venta">
        <x-slot:cardTools>
            <a href="#" class="btn btn-primary mr-2" wire:click='create'>
                <i class="fas fa-arrow-circle-left mr-1"></i> Ir a ventas
            </a>

            <a href="#" class="btn btn-danger" wire:click='create'>
                <i class="fas fa-trash mr-1"></i> Cancelar venta
            </a>

        </x-slot>

        {{-- CONTENT --}}
        <div class="row">
            {{-- Detalles de la venta --}}
            <div class="col-md-6">
                Detalles de la venta
            </div>
            {{-- Columna productos --}}
            <div class="col-md-6">
                Columna productos
            </div>
        </div>


        <x-slot:cardFooter>

        </x-slot>
    </x-card>

</div>
