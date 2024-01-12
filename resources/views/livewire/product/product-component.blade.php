<div>
    <x-card cardTitle="Listado productos ({{ $totalRegistros }})">
        <x-slot:cardTools>
            <a class="btn btn-primary" wire:click='create'>
                <i class="fas fa-plus-circle"></i> Crear producto</a>
        </x-slot:cardTools>
        <x-table>
            <x-slot:thead>
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio de Venta</th>
                    <th>Stock</th>
                    <th>Categoria</th>
                    <th>Estado</th>
                    <th width="3%">Ver</th>
                    <th width="3%">Editar</th>
                    <th width="3%">Borrar</th>
                </tr>

            </x-slot:thead>
            @forelse ($products as $product)
                <tr class="tableCentrarY">
                    <td>{{ $product->id }}</td>
                    <td>
                        <x-image :item="$product" />
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{!! $product->precio !!}</td>
                    <td>{!! $product->stockLabel !!}</td>
                    <td>
                        <a class="badge badge-secondary"
                            href="{{ route('categories.show', $product->category->id) }}">{{ $product->category->name }}</a>
                    </td>
                    <td>{!! $product->activeLabel !!}</td>
                    <td>
                        <a href="{{ route('products.show', $product) }}" title="ver" class="btn btn-success btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                    <td>
                        <a wire:click='edit({{ $product->id }})' title="editar" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <a wire:click="$dispatch('delete',{
                            id:{{ $product->id }},
                            eventName: 'destroyProduct'
                        })"
                            title="eliminar" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr class="text-center">
                    <td colspan="10">
                        No existen resultados en productos
                    </td>
                </tr>
            @endforelse

        </x-table>
        <x-slot:cardFooter>
            {{ $products->links() }}
        </x-slot:cardFooter>
    </x-card>
    @include('products.modal')
</div>
