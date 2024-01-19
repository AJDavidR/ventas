@props(['item' => null, 'maxSize' => '', 'maxSizeY' => '', 'Size' => '', 'SizeY' => ''])
<div style="max-width: {{ $Size }}; max-height: {{ $SizeY }}; width: {{ $Size }}; height: {{ $SizeY }};" 
    class="text-center">
    <div class="">
        {{-- imagen --}}
        <div>
            <img src="{{ $item->image ? Storage::url('public/' . $item->image->url) : asset('no-image.png') }}"
                class="rounded" width="175px" style="height: 120px;">
        </div>

        <div class="mx-2">

            {{-- nombre --}}
            <div style="max-width: 170px;" class="d-flex flex-wrap">
                <div class="text-white">
                    <p>{{ $item->name }}</p>
                </div>
            </div>
    
            {{-- precio --}}
            <div style="max-width: 170px; overflow: hidden; text-overflow: ellipsis;">
                <div class="font-weight-bold">
                    <p>{{ money($item->precio_venta) }}</p>
                </div>
            </div>
            
        </div>
    </div>
</div>
