{{-- ----------------------> Modal para usuarios <---------------------- --}}

<x-modal modalId="modalUser" modalTitle="Users">
    <form wire:submit={{ $Id == 0 ? 'store' : "update($Id)" }}>
        <div class="form-row">

            {{-- Input name --}}
            <div class="form-group col-12 col-md-6">
                <label for="name">Nombre:</label>
                <input wire:model='name' type="text" class="form-control" placeholder="Nombre" id="name">
                @error('name')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input email --}}
            <div class="form-group col-12 col-md-6">
                <label for="email">Correo electronico:</label>
                <input wire:model='email' type="email" class="form-control" placeholder="correo@#mail.com"
                    id="email">
                @error('email')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input password --}}
            <div class="form-group col-12 col-md-6">
                <label for="password">Contraseña:</label>
                <input wire:model='password' type="password" class="form-control" placeholder="contraseña"
                    id="password">
                @error('password')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input re_password --}}
            <div class="form-group col-12 col-md-6">
                <label for="re_password">Repetir contraseña:</label>
                <input wire:model='re_password' type="password" class="form-control" placeholder="repetir contraseña"
                    id="re_password">
                @error('re_password')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Cheack box Admin --}}
            <div class="form-group form-check col-md-6">
                <div class="icheck-primary">
                    <input type="checkbox" wire:model='admin' id="admin" checked>
                    <label for="admin">
                        ¿Es Administrador?
                    </label>
                </div>

                @error('admin')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Cheack box Active --}}
            <div class="form-group form-check col-md-6">
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
            <div class="form-group col-12 col-md-12">
                <label for="image">imagen</label>
                <input type="file" wire:model='image' id="image" accept="image/*">

                @error('image')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Imagen --}}
            <div class="form-group col-12 col-md-12 d-flex">

                @if ($Id > 0)
                    <div class="form-group col-12 col-md-6 dx-2 text-center">
                        <label for="img_actual">Imagen actual</label>
                        <div>
                            <x-image :item="$User = App\Models\User::find($Id)" id="img_actual" float="float-left" size="200"
                                sizeY="300" />
                        </div>
                    </div>
                @endif

                @if ($this->image)
                    <div class="form-group col-12 col-md-6 dx-2 text-center">
                        <label for="img_up">Imagen subida</label>
                        <div>
                            <img src="{{ $image->temporaryUrl() }}" id="img_up" class="rounded float-right"
                                width="200" style="max-height: 300px;">
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
