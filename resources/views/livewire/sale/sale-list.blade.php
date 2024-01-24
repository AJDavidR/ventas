<div>
    <x-card cardTitle="Listado ventas ({{ $totalRegistros }})">
        <x-slot:cardTools>
            <a href="{{ route("sales.create") }}" class="btn btn-primary">
                <i class="fas fa-cart-plus"></i>
                Crear venta
            </a>
        </x-slot>

        <x-table>
            <x-slot:thead>
                <th>ID</th>
                <th>Nombre</th>
                <th width="3%">...</th>
                <th width="3%">...</th>
                <th width="3%">...</th>

            </x-slot>

            @forelse ($sales as $sale)
                <tr>
                    <td>{{ $sale->id }}</td>
                    <td>{{ $sale->total }}</td>
                    <td>
                        <a href="" class="btn btn-success btn-sm" title="Ver">
                            <i class="far fa-eye"></i>
                        </a>
                    </td>
                    <td>
                        <a href="#" wire:click='edit({{ $sale->id }})' class="btn btn-primary btn-sm"
                            title="Editar">
                            <i class="far fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <a wire:click="$dispatch('delete',{id: {{ $sale->id }}, eventName:'destroySale'})"
                            class="btn btn-danger btn-sm" title="Eliminar">
                            <i class="far fa-trash-alt"></i>
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
            {{ $sales->links() }}

        </x-slot>
    </x-card>


</div>
