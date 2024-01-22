<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-cart-plus"></i>
            Detalles venta 
            # {{ $totalRegistros }}
        </h3>
    </div>
    <!-- card-body -->
    <div class="card-body">
        
        {{-- Card cliente --}}
        @livewire("saleB.client-b")

        <div class="table-responsive">
            <table class="table table-hover table-sm table-striped text-center">
                <thead>
                    <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">Precio</th>
                        <th scope="col" width="15%">Qty</th>
                        <th scope="col">Sub total</th>
                        <th scope="col">Accion</th>
                    </tr>

                </thead>
                <tbody>
                    @forelse ($cart as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>
                                <b>{{ money($product->price) }}</b>
                            </td>
                            <td>
                                <!-- Botones para aumentar o disminuir la cantidad del producto en el carrito -->
                                <button wire:click="decrement({{ $product->id }})" class="btn btn-primary btn-xs bg-red"
                                    wire:loading.attr='disabled' 
                                    wire:target='decrement' 
                                    >
                                    -
                                </button>

                                <span class="mx-1">{{ $product->quantity }}</span>

                                <button wire:click="increment({{ $product->id }})" class="btn btn-primary btn-xs bg-green"
                                    wire:loading.attr='disabled' 
                                    wire:target='increment' 
                                    {{ $product->quantity>=$product->associatedModel->stock ? 'disabled' : '' }}
                                    >
                                    +
                                </button>

                            </td>
                            <td>
                                <b>{{ money($product->quantity * $product->price) }}</b>
                            </td>
                            <td>
                                <!-- Boton para eliminar el producto del carrito -->
                                <button 
                                    wire:click='removeItem({{ $product->id }}, {{ $product->quantity }})' 
                                    class="btn btn-danger btn-xs"
                                    title="Eliminar">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Sin Registros</td>
                        </tr>
                    @endforelse

                    <tr>
                        <td colspan="2"></td>
                        <td>
                            <h5>Total:</h5>
                        </td>
                        <td>
                            <h5>
                                <span class="badge badge-pill badge-secondary">
                                    {{ money($total) }}
                                </span>
                            </h5>
                        </td>
                        <td></td>
                    </tr>
                    <tr>

                        <td colspan="7">
                            <strong>Total en letras:</strong>
                            {{ numeroLetras($total) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    <!-- end-card-body -->
</div>
