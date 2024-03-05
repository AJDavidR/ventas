<div id="row1" class="row">
    <div id="col-1-1" class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <b>Productos mas vendidos hoy</b>
                </h3>
                <div class="card-tools">

                </div>
            </div>
            {{-- Card Header --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($productosMasVendidosHoy as $product)
                                <tr>
                                    <th>{{ $product->product_id }}</th>
                                    <th>
                                        <img src="{{ asset($product->image) }}" width="50px" class="img-fluid rounded" alt="">
                                    </th>
                                    <th>{{ $product->name }}</th>
                                    <th>{{ money($product->price) }}</th>
                                    <th>
                                        <span class="bg-success badge">
                                            {{ $product->total_quantity }}
                                        </span>
                                    </th>
                                    <th>{{ money($product->price * $product->total_quantity) }}</th>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        No hay ventas hoy
                                    </td> 
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- card body --}}
        </div>
    </div>

    <div id="col-1-2" class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <b>Productos mas vendidos este mes</b>
                </h3>
                <div class="card-tools">

                </div>
            </div>
            {{-- Card Header --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($productosMasVendidosMes as $product)
                                <tr>
                                    <th>{{ $product->product_id }}</th>
                                    <th>
                                        <img src="{{ asset($product->image) }}" width="50px" class="img-fluid rounded" alt="">
                                    </th>
                                    <th>{{ $product->name }}</th>
                                    <th>{{ money($product->price) }}</th>
                                    <th>
                                        <span class="bg-success badge">
                                            {{ $product->total_quantity }}
                                        </span>
                                    </th>
                                    <th>{{ money($product->price * $product->total_quantity) }}</th>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        No hay ventas este mes
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- card body --}}
        </div>
    </div>
</div>

<div id="row2" class="row">
    <div id="col-2-1" class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <b>Productos mas vendidos</b>
                </h3>
                <div class="card-tools">

                </div>
            </div>
            {{-- Card Header --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($productosMasVendidos as $product)
                                <tr>
                                    <th>{{ $product->product_id }}</th>
                                    <th>
                                        <img src="{{ asset($product->image) }}" width="50px" class="img-fluid rounded" alt="">
                                    </th>
                                    <th>{{ $product->name }}</th>
                                    <th>{{ money($product->price) }}</th>
                                    <th>
                                        <span class="bg-success badge">
                                            {{ $product->total_quantity }}
                                        </span>
                                    </th>
                                    <th>{{ money($product->price * $product->total_quantity) }}</th>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        No hay ventas este Año
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- card body --}}
        </div>
    </div>

    <div id="col-2-2" class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <b>Productos agregados recientemente</b>
                </h3>
                <div class="card-tools">

                </div>
            </div>
            {{-- Card Header --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($productosRecientes as $product)
                                <tr>
                                    <th>{{ $product->id }}</th>
                                    <th>
                                        <x-image :item="$product" size="50" />
                                    </th>
                                    <th>{{ $product->name }}</th>
                                    <th>{{ money($product->precio_venta) }}</th>
                                    <th>
                                        {!! $product->stockLabel !!}
                                    </th>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        No hay productos recientes
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- card body --}}
        </div>
    </div>
</div>
