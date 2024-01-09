@props(['item' => null])
<img src="{{ $item->image ? Storage::url('public/' . $item->image->url) : asset('no-image.png') }}" class="rounded"
    width="70" height="50">
