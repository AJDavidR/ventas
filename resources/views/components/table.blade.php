{{-- ----------------------> Tabla esquema general <---------------------- --}}
@props(['classSelect' => 'w-50', 'inputClass' => 'w-25'])
<div class="mb-3 d-flex justify-content-between">

    

    <div class="{{ $classSelect }}">
        <div class="text-left">
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

    <div class="input-group {{ $inputClass }}">

        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fas fa-search"></i>
            </span>
        </div>

        <input type="text" wire:model.live.debounce.300ms='search' placeholder="Buscar" class="form-control">
    </div>
    

</div>
<div class="table-responsive">
    <table class="table table-striped table-hover text-center align-items">
        <thead>
            <tr>
                {{ $thead }}
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>
