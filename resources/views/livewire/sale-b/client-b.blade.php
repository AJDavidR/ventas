<div>
    <div class="form-group">
        <h3>
            <label>Cliente: {{ $nameClient }}</label>
        </h3>

        <!--input group -->
        <div class="input-group" wire:ignore>
                    {{-- ??? wire:ignore en este caso es para que no afecte client en el select --}}
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>

            <select wire:model.live.debounce='client' class="form-control" id="select2">
                
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach

            </select>

            <div class="input-group-append">
                <button wire:click="openModal" id="btn-client-add" class="btn bg-blue btn-sm input-group-text">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <!-- /.input group -->
    </div>
    <!-- Modal Cliente -->
    @include('clients.modal')
    {{-- End Modal --}}


    @section('styles')
        <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    @endsection
    @section('js')
        <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
        <script>
            $("#select2").select2({
                theme: "bootstrap4"
            });

            $("#select2").on('change', function() {
                Livewire.dispatch('client_id', {
                    id: $(this).val()
                })
            })
        </script>
    @endsection

</div>
