<div>
    <x-card cardTitle="Listado categorias ({{ $totalRegistros }})">
        <x-slot:cardTools>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalCategory">Crear
                categoria</a>
        </x-slot:cardTools>
        <x-table>
            <x-slot:thead>
                <th>ID</th>
                <th>Nombre</th>
                <th width="3%">...</th>
                <th width="3%">...</th>
                <th width="3%">...</th>

            </x-slot:thead>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="#" title="ver" class="btn btn-success btn-xs">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                    <td>
                        <a href="#" title="editar" class="btn btn-primary btn-xs">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <a href="#" title="eliminar" class="btn btn-danger btn-xs">
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
        <form wire:submit="store">
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
            <button class="btn btn-primary float-right">Guardar</button>
        </form>
    </x-modal>
</div>
