@props(['item' => null, 'maxSize' => '', 'maxSizeY' => '', 'Size' => '', 'SizeY' => ''])
<div wire:click='addProduct({{ $product->id }})' wire:loading.attr='disabled' wire:target='addProduct'
    class="mt-4 rounded mx-2" style="cursor: pointer; box-shadow: 1px 1px 3px 3px #3b3b3b;">
    {{-- <x-itemP :item="$product" size="200px" sizeY="200px" class="" /> --}}
    <div style=" width: {{ $Size }}; height: {{ $SizeY }};"
        class="text-center">
        <div class="">
            {{-- imagen --}}
            <div>
                <img src="{{ $product->image ? Storage::url('public/' . $product->image->url) : asset('no-image.png') }}"
                    class="rounded" width="175px" style="height: 120px;">
            </div>

            <div class="mx-2">

                {{-- nombre --}}
                <div style="max-width: 170px;" class="d-flex flex-wrap">
                    <div class="text-white w-100">
                            <p>{{ $product->name }}</p>
                    </div>
                </div>

                {{-- precio --}}
                <div style="max-width: 170px; overflow: hidden; text-overflow: ellipsis;">
                    <div class="font-weight-bold">
                        <p>{{ money($product->precio_venta) }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
