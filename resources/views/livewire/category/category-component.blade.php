<div>
    <x-card cardTitle="Listado categorias ({{ $totalRegistros }})" cardFooter="Card Footer">
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
            <tr>
                <td>...</td>
                <td>...</td>
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
        </x-table>
    </x-card>
    <x-modal modalId="modalCategory" modalTitle="Categorias">
        <form wire:submit="store">
            <div class="row">
                <div class="col">
                    <input wire:model="name" type="text" class="form-control" placeholder="Nombre Categoria">
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
