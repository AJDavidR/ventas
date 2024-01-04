<div class="mb-3 d-flex justify-content-between">
    <div>
        <span>Mostrar</span>
        <select name="" id="">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        <span>Entradas</span>
    </div>
    <div>
        <input type="text" wire:model.live='search' placeholder="Buscar" class="form-control">
    </div>
</div>
<div class="table-responsive">
    <table class="table">
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
