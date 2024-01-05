<div>
    <x-card cardTitle="Listado categorias ({{ $totalRegistros }})">
        <x-slot:cardTools>
            <a href="#" class="btn btn-primary" wire:click='create'>
                <i class="fas fa-plus-circle"></i> Crear categoria</a>
        </x-slot:cardTools>
        <x-table>
            <x-slot:thead>
                <th>ID</th>
                <th>Nombre</th>
                <th width="3%">Ver</th>
                <th width="3%">Editar</th>
                <th width="3%">Borrar</th>

            </x-slot:thead>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td class="text-center">
                        <a href="{{ route('categories.show', $category) }}" title="ver"
                            class="btn btn-success btn-xs">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a wire:click='edit({{ $category->id }})' title="editar" class="btn btn-primary btn-xs">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a wire:click="$dispatch('delete',{
                            id:{{ $category->id }},
                            eventName: 'destroyCategory'
                        })"
                            title="eliminar" class="btn btn-danger btn-xs">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr class="text-center">
                    <td colspan="5">
                        No existen resultados en categorias
                    </td>
                </tr>
            @endforelse

        </x-table>
        <x-slot:cardFooter>
            {{ $categories->links() }}
        </x-slot:cardFooter>
    </x-card>
    <x-modal modalId="modalCategory" modalTitle="Categorias">
        <form wire:submit={{ $Id == 0 ? 'save' : "save($Id)" }}>
            <div class="form-row">
                <div class="form-group col-12">
                    <label for="name">Nombre: </label>
                    <input wire:model="form.name" type="text" class="form-control" id="name"
                        placeholder="Nombre de Categoria">
                    @error('form.name')
                        <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr>
            <button class="btn btn-primary float-right">{{ $Id == null ? 'Guardar' : 'Editar' }}</button>
        </form>
    </x-modal>
</div>
