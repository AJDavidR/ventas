{{-- ----------------------> Modal para productos <---------------------- --}}

<x-modal modalId="modalProduct" modalTitle="Productos" modalSize="modal-lg">
    <form wire:submit={{ $Id == 0 ? 'store' : "update($Id)" }}>
        <div class="form-row">

            {{-- input Name --}}
            <div class="form-group col-md-7">
                <label for="name">Nombre: </label>
                <input wire:model="name" type="text" class="form-control" id="name"
                    placeholder="Nombre de Producto">

                @error('name')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- select Categoria --}}
            <div class="form-group col-md-5">
                <label for="category_id">Categoria: </label>
                <select wire:model='category_id' id="category_id" class="form-control">
                    <option value="">Seleccionar</option>
                    @foreach ($this->categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                @error('category_id')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Text area Descripcion --}}
            <div class="form-group col-md-12">
                <label for="descripcion">Descripcion: </label>
                <textarea wire:model='descripcion' class="form-control" id="descripcion" rows="3"></textarea>

                @error('descripcion')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- input Precio compra --}}
            <div class="form-group col-md-4">
                <label for="precio_compra">Precio compra: </label>
                <input wire:model="precio_compra" min="0" step="any" type="number" class="form-control"
                    id="precio_compra" placeholder="Ej: 1000000">

                @error('precio_compra')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- input Precio venta --}}
            <div class="form-group col-md-4">
                <label for="precio_venta">Precio venta: </label>
                <input wire:model="precio_venta" min="0" step="any" type="number" class="form-control"
                    id="precio_venta" placeholder="Ej: 1000000">

                @error('precio_venta')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- input Codigo de barras --}}
            <div class="form-group col-md-4">
                <label for="codigo_barras">Codigo de barras: </label>
                <input wire:model="codigo_barras" type="text" class="form-control" id="codigo_barras"
                    placeholder="Codigo de barras">

                @error('codigo_barras')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- input Stock --}}
            <div class="form-group col-md-4">
                <label for="stock">Stock: </label>
                <input wire:model="stock" min="0" type="number" class="form-control" id="stock"
                    placeholder="Ej: 100">

                @error('stock')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- input Stock minimo --}}
            <div class="form-group col-md-4">
                <label for="stock_minimo">Stock minimo: </label>
                <input wire:model="stock_minimo" type="number" class="form-control" id="stock_minimo">

                @error('stock_minimo')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- input Fecha vencimiento --}}
            <div class="form-group col-md-4">
                <label for="fecha_vencimiento">Fecha de vencimiento: </label>
                <input wire:model="fecha_vencimiento" type="date" class="form-control" id="fecha_vencimiento">

                @error('fecha_vencimiento')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Cheack box Active --}}
            <div class="form-group col-md-6">
                <div class="icheck-primary">
                    <input type="checkbox" wire:model='active' id="active" checked>
                    <label for="active">
                        ¿esta activo?
                    </label>
                </div>

                @error('active')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input Imagen --}}
            <div class="form-group col-md-6">
                <label for="image">imagen:</label>
                <input type="file" wire:model='image' id="image" accept="image/*">

                @error('image')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Imagen --}}

            <div class="form-group col-12 col-md-12 d-flex">
                @if ($Id > 0)
                    <div class="form-group col-12 col-md-6">
                        <label for="img_actual" class="d-block text-center">Imagen actual</label>
                        <div class="text-center">
                            <x-image :item="$Product = App\Models\Product::find($Id)" id="img_actual" size="200" />
                        </div>
                    </div>
                @endif

                @if ($this->image)
                    <div class="form-group col-12 col-md-6">
                        <label for="img_up" class="d-block text-center">Imagen subida</label>
                        <div class="text-center">
                            <img src="{{ $image->temporaryUrl() }}" id="img_up" class="rounded mx-auto d-block"
                                width="200" style="position: relative;">
                        </div>
                    </div>
                @endif
            </div>


        </div>

        <hr>
        <button wire:loading.attr='disabled'
            class="btn btn-primary float-right">{{ $Id == 0 ? 'Guardar' : 'Editar' }}</button>
    </form>
</x-modal>
