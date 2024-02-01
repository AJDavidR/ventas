<div>
    <x-card cardTitle="Datos tienda">
        <x-slot:cardTools>
            <a class="btn btn-primary" wire:click='create'>
                <i class="fas fa-plus-circle"></i> Crear
            </a>
        </x-slot>

        <div class="table-responsive">

            <table class="table table-hover table-striped text-center">
                <thead>
                    <th>ID</th>
                    <th>
                        <i class="fas fa-image"></i>
                    </th>
                    <th>Nombre</th>
                    <th>Slogan</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Direccion</th>
                    <th>Ciudad</th>
                    <th width="3%">Editar</th>
                    <th width="3%">Borrar</th>

                </thead>

                <tbody>
                    @forelse ($shops as $shop)
                        <tr>
                            <td>{{ $shop->id }}</td>
                            <td>
                                <x-image :item="$shop" />
                            </td>
                            <td>{{ $shop->name }}</td>
                            <td>{{ $shop->slogan }}</td>
                            <td>{{ $shop->telefono }}</td>
                            <td>{{ $shop->email }}</td>
                            <td>{{ $shop->direccion }}</td>
                            <td>{{ $shop->ciudad }}</td>
                            <td>
                                <button wire:click='edit({{ $shop->id }})' class="btn btn-primary float-right">
                                    Editar
                                </button>
                            </td>
                            <td>
                                <a wire:click="$dispatch('delete',{
                                    id:{{ $shop->id }},
                                    eventName: 'destroyShop'
                                })"
                                    title="eliminar" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>

                        </tr>

                    @empty

                        <tr class="text-center">
                            <td colspan="10">Sin registros</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

        <x-slot:cardFooter>
            {{ $shops->links() }}
        </x-slot>
    </x-card>

    @include("shops.modal")

</div>
