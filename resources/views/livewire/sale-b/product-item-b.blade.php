<div wire:click='addProduct({{ $product->id }})'
    wire:loading.attr='disabled' 
    wire:target='addProduct' 
    class="mt-4 rounded mx-2"
    style="cursor: pointer; box-shadow: 1px 1px 3px 3px #3b3b3b;"
    >
    <x-itemP :item="$product" size="200px" sizeY="200px" class=""/>
</div>