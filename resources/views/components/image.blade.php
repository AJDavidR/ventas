@props(['item' => null, 'size' => 70, 'float' => '', 'sizeY' => ''])
<img src="{{ $item->image ? Storage::url('public/' . $item->image->url) : asset('no-image.png') }}"
    class="rounded {{ $float }}" width="{{ $size }}" style="max-height: {{ $sizeY }}px;">
