{{-- MODAL Shop --}}
<x-modal modalId="modalShop" modalTitle="Datos tienda" modalSize="modal-lg">
    <form wire:submit={{ $Id == 0 ? 'store' : "update($Id)" }}>

        <div class="form-row">

            {{-- Input Name --}}
            <div class="form-group col-md-5">
                <label for="name">Nombre:</label>
                <input wire:model='name' type="text" class="form-control" placeholder="Nombre tienda" id="name">
                @error('name')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input Slogan --}}
            <div class="form-group col-md-7">
                <label for="slogan">Slogan:</label>
                <input wire:model='slogan' type="text" class="form-control" placeholder="Slogan tienda"
                    id="slogan">
                @error('slogan')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>


            {{-- Input Telefono --}}
            <div class="form-group col-md-5">
                <label for="telefono">Telefono:</label>
                <input wire:model='telefono' type="text" class="form-control" placeholder="Telefono tienda"
                    id="telefono">
                @error('telefono')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>


            {{-- Input Telefono --}}
            <div class="form-group col-md-7">
                <label for="email">Email:</label>
                <input wire:model='email' type="email" class="form-control" placeholder="Email tienda" id="email">
                @error('email')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input Direccion --}}
            <div class="form-group col-md-5">
                <label for="direccion">Direccion:</label>
                <input wire:model='direccion' type="text" class="form-control" placeholder="Direccion tienda"
                    id="direccion">
                @error('direccion')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input Ciudad --}}
            <div class="form-group col-md-7">
                <label for="ciudad">Ciudad:</label>
                <input wire:model='ciudad' type="text" class="form-control" placeholder="Ciudad tienda"
                    id="ciudad">
                @error('ciudad')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input imagen --}}
            <div class="form-group col-md-6">

                <label for="image">Imagen:</label>
                <input wire:model='image' type="file" id="image" accept="image/*">

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
                            <x-image :item="$shop = App\Models\Shop::find($Id)" id="img_actual" size="200" sizeY="300" />
                        </div>
                    </div>
                @endif

                @if ($this->image)
                    <div class="form-group col-12 col-md-6">
                        <label for="img_up" class="d-block text-center">Imagen subida</label>
                        <div class="text-center">
                            <img src="{{ $image->temporaryUrl() }}" id="img_up" class="rounded mx-auto d-block"
                                width="200" style="max-height: 300px;" style="position: relative;">
                        </div>
                    </div>
                @endif
            </div>

        </div>

        <hr>
        <button wire:loading.attr='disabled' class="btn btn-primary float-right">{{ $Id == 0 ? 'Guardar' : 'Editar' }}
        </button>

    </form>
</x-modal>
