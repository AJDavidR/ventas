<div class="card card-info">
    <div class="card-body">

        {{-- buscador --}}
        <div class="input-group">

            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-search"></i>
                </span>
            </div>
    
            <input type="text" wire:model.live.debounce.300ms='search' placeholder="Buscar" class="form-control">
        </div>

        {{-- item --}}
        <div class="d-flex flex-wrap">
            @forelse ($products as $product)
                <livewire:saleB.product-itemB :product="$product" :wire:key="$product->id" />

            @empty
                <p class="w-100">Sin Registros</p>
            @endforelse
        </div>

        {{-- select paginator --}}
        <div class="mt-3">
            <div class="text-right">
                <span>Mostrar</span>
                <select wire:model.live='cant'>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span>Entradas</span>
            </div>
        </div>
    </div>


</div>
