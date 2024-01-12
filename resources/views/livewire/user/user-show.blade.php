<x-card cardTitle="Detalles de usuario">
    <x-slot:cardTools>
        <a href="{{ route('users') }}" class="btn btn-primary">
            <i class="fas fa-arrow-circle-left mr-2"></i>Regresar
        </a>

    </x-slot:cardTools>

    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <x-image :item="$user" size="250" sizeY="350" />
                    </div>
                    <h2 class="profile-username text-center mb-2">{{ $user->name }}</h2>
                    <p class="text-muted text-center">
                        {!! $user->admin
                            ? '<span class="badge badge-pill badge-warning">Administrador</span>'
                            : '<span class="badge badge-pill badge-light">Vendedor</span>' !!}
                    </p>
                    <ul class="list-group mb-3">
                        <li class="list-group-item">
                            <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                        </li>

                        <li class="list-group-item">
                            <b>Estado</b> <a class="float-right">{!! $user->active
                                ? '<span class="badge badge-success">Activo</span>'
                                : '<span class="badge badge-warning">Inactivo</span>' !!}</a>
                        </li>

                        <li class="list-group-item">
                            <b>Creado</b> <a class="float-right">{{ $user->created_at->format('Y-m-d') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Precio de venta</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($category->products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                <x-image :item="$product" />
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{!! $product->precio !!}</td>
                            <td>{!! $product->stockLabel !!}</td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>

    </div>

</x-card>
