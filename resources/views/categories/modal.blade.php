<x-modal modalId="modalCategory" modalTitle="Categorias">
    <form wire:submit={{ $Id == 0 ? 'store' : "update($Id)" }}>
        <div class="form-row">
            <div class="form-group col-12">
                <label for="name">Nombre: </label>
                <input wire:model="name" type="text" class="form-control" id="name"
                    placeholder="Nombre de Categoria">
                @error('name')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <hr>
        <button class="btn btn-primary float-right">{{ $Id == 0 ? 'Guardar' : 'Editar' }}</button>
    </form>
</x-modal>
