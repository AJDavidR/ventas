<div>
    <x-card cardTitle="Listado productos ({{ $totalRegistros }})">
        <x-slot:cardTools>
            <a class="btn btn-primary" wire:click='create'>
                <i class="fas fa-plus-circle"></i> Crear producto</a>
        </x-slot:cardTools>
        <x-table>
            <x-slot:thead>
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

            </x-slot:thead>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>imagen</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->precio_venta }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->category_id }}</td>
                    <td>Active</td>
                    <td class="text-center">
                        <a href="{{ route('products.show', $product) }}" title="ver" class="btn btn-success btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a wire:click='edit({{ $product->id }})' title="editar" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td class="text-center">
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
    <x-modal modalId="modalProduct" modalTitle="Productos">
        <form wire:submit={{ $Id == 0 ? 'store' : "update($Id)" }}>
            <div class="form-row">
                <div class="form-group col-12">
                    <label for="name">Nombre: </label>
                    <input wire:model="name" type="text" class="form-control" id="name"
                        placeholder="Nombre de Producto">
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
