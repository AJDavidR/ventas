<div>
    <x-card cardTitle="Crear Venta">
        <x-slot:cardTools>
            <a href="#" class="btn btn-primary btn-sm mr-2">
                <i class="fas fa-arrow-circle-left mr-1"></i> Ir a ventas
            </a>

            <a href="#" class="btn btn-danger btn-sm" wire:click='clear'>
                <i class="fas fa-trash mr-1"></i> Cancelar venta
            </a>

        </x-slot>

        {{-- CONTENT --}}
        <div class="row">
            {{-- Detalles de la venta --}}
            <div class="col-md-6">
                @include('sales.card-details')
            </div>
            {{-- Columna productos --}}
            <div class="col-md-6">
                @include('sales.list-products')
            </div>
        </div>


        <x-slot:cardFooter>

        </x-slot>
    </x-card>

</div>
