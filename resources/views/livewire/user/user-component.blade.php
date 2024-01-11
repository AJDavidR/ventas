<div>
    <x-card cardTitle="Listado categorias ({{ $this->totalRegistros }})">
        <x-slot:cardTools>
            <a class="btn btn-primary" wire:click='create'>
                <i class="fas fa-plus-circle"></i> Crear
            </a>
        </x-slot>

        <x-table>
            <x-slot:thead>
                <th>ID</th>
                <th>Nombre</th>
                <th width="3%">Ver</th>
                <th width="3%">Editar</th>
                <th width="3%">Borrar</th>

            </x-slot>

            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>
                        <a href="#" title="ver" class="btn btn-success btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                    <td>
                        <a wire:click='edit({{ $user->id }})' title="editar" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <a wire:click="$dispatch('delete',{
                            id:{{ $user->id }},
                            eventName: 'destroyProduct'
                        })"
                            title="eliminar" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>

            @empty

                <tr class="text-center">
                    <td colspan="5">Sin registros</td>
                </tr>
            @endforelse

        </x-table>

        <x-slot:cardFooter>
            {{ $users->links() }}

        </x-slot>
    </x-card>


    <x-modal modalId="modalUser" modalTitle="Users">
        <form wire:submit={{ $Id == 0 ? 'store' : "update($Id)" }}>
            <div class="form-row">
                <div class="form-group col-12">
                    <label for="name">Nombre:</label>
                    <input wire:model='name' type="text" class="form-control" placeholder="Nombre" id="name">
                    @error('name')
                        <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr>
            <button class="btn btn-primary float-right">{{ $Id == 0 ? 'Guardar' : 'Editar' }}</button>
        </form>
    </x-modal>

</div>
