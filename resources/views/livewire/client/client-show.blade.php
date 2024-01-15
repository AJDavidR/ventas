<x-card cardTitle="Detalles del Cliente">
    <x-slot:cardTools>
        <a href="{{ route('clients') }}" class="btn btn-primary">
            <i class="fas fa-arrow-circle-left mr-2"></i>Regresar
        </a>

    </x-slot:cardTools>

    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">

                    <h2 class="profile-username text-center mb-2">{{ $client->name }}</h2>

                    <ul class="list-group mb-3">

                        <li class="list-group-item">
                            <b>Identificacion</b> <a class="float-right">{{ $client->identificacion }}</a>
                        </li>

                        <li class="list-group-item">
                            <b>Email</b> <a class="float-right">{{ $client->email }}</a>
                        </li>

                        <li class="list-group-item">
                            <b>Telefono</b> <a class="float-right">{{ $client->telefono }}</a>
                        </li>

                        <li class="list-group-item">
                            <b>Empresa</b> <a class="float-right">{{ $client->empresa }}</a>
                        </li>

                        <li class="list-group-item">
                            <b>Nit</b> <a class="float-right">{{ $client->nit }}</a>
                        </li>

                        <li class="list-group-item">
                            <b>Creado</b> <a class="float-right">{{ $client->created_at->format('Y-m-d') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-9">
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
