<tr>
    <td>{{ $product->id }}</td>
    <td>
        <x-image :item="$product" size="60" />

    </td>
    <td>{{ $product->name }}</td>
    <td>

        {!! money($product->precio_venta) !!}
    </td>
    <td>
        {!! $stockLabel !!}
        {{-- @if ($product->stock >= $product->stock_minimo)
            <span class="badge badge-pill badge-success">{{ $product->stock }}</span>
        @else
            <span class="badge badge-pill badge-danger">{{ $product->stock }}</span>
        @endif --}}
    </td>
    <td>

        <button 
            class="btn btn-primary btn-sm"
            wire:click='addProduct({{ $product->id }})'
            wire:loading.attr='disabled' 
            wire:target='addProduct' 
            title="Agregar">
            <i class="fas fa-plus-circle"></i>
        </button>
    </td>

</tr>