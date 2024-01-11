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
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Perfil</th>
                <th>Estado</th>
                <th width="3%">Ver</th>
                <th width="3%">Editar</th>
                <th width="3%">Borrar</th>

            </x-slot>

            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>
                        <x-image :item="$user" />
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->admin == 1)
                            <span class="badge badge-pill badge-warning">
                                {{ 'Administrador' }}
                            </span>
                        @else
                            <span class="badge badge-pill badge-light">
                                {{ 'Vendedor' }}
                            </span>
                        @endif
                    </td>
                    <td>
                        @if ($user->active == 1)
                            <span class="badge badge-pill badge-success">
                                {{ 'Activo' }}
                            </span>
                        @else
                            <span class="badge badge-pill badge-secondary">
                                {{ 'Inactivo' }}
                            </span>
                        @endif
                    </td>
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
                    <td colspan="9">Sin registros</td>
                </tr>
            @endforelse

        </x-table>

        <x-slot:cardFooter>
            {{ $users->links() }}

        </x-slot>
    </x-card>

    @include('users.modal')

</div>
