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
                            class="btn btn-success btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a wire:click='edit({{ $category->id }})' title="editar" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a wire:click="$dispatch('delete',{
                            id:{{ $category->id }},
                            eventName: 'destroyCategory'
                        })"
                            title="eliminar" class="btn btn-danger btn-sm">
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
    @include('categories.modal')
</div>
