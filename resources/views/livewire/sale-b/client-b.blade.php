<div>
    <div class="form-group">
        <label>Cliente: {{ $nameClient }}</label>

        <!--input group -->
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>

            <select class="form-control">
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
    @endsection
    @section('js')
        <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.css') }}">
    @endsection

</div>
