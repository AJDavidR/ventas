<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-tshirt"></i> Productos</h3>
    </div>

    <div class="card-body">

        <x-table>

            <x-slot:thead>
                <th scope="col">#</th>
                <th scope="col"><i class="fas fa-image"></i></th>
                <th scope="col">Nombre</th>
                <th scope="col">Precio.vt</th>
                <th scope="col">Stock</th>
                <th scope="col">...</th>

            </x-slot>

            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        <x-image :item="$product" />

                    </td>
                    <td>{{ $product->name }}</td>
                    <td>
                        <span style="color: rgb(2, 210, 2);">$</span>
                        {!! '<b>' . number_format($product->precio_venta, 0, ',', '.') . '</b>' !!}
                    </td>
                    <td>
                        @if ($product->stock >= $product->stock_minimo)
                            <span class="badge badge-pill badge-success">{{ $product->stock }}</span>
                        @else
                            <span class="badge badge-pill badge-danger">{{ $product->stock }}</span>
                        @endif
                    </td>
                    <td>

                        <button class="btn btn-primary btn-sm" title="Agregar">
                            <i class="fas fa-plus-circle"></i>
                        </button>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="10">Sin Registros</td>
                </tr>
            @endforelse

        </x-table>

    </div>
    <div class="card-footer">
        {{ $products->links() }}
    </div>

</div>
