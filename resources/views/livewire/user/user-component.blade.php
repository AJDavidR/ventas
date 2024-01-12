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
                <tr class="tableCentrarY">
                    <td>{{ $user->id }}</td>
                    <td>
                        <x-image :item="$user" sizeY="70" />
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        {!! $user->admin
                            ? '<span class="badge badge-pill badge-warning">Administrador</span>'
                            : '<span class="badge badge-pill badge-light">Vendedor</span>' !!}
                    </td>
                    <td>
                        {!! $user->active
                            ? '<span class="badge badge-success">Activo</span>'
                            : '<span class="badge badge-warning">Inactivo</span>' !!}
                    </td>
                    <td>
                        <a href="{{ route('users.show', $user) }}" title="ver" class="btn btn-success btn-sm">
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
                            eventName: 'destroyUser'
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
