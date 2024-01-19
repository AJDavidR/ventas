<div>
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-user"></i> Cliente: {{ $nameClient }}</h3>
            <div class="card-tools">
                <button wire:click="openModal" class="btn bg-purple btn-sm">Crear cliente</button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Seleccionar cliente:</label>

                <!--input group -->
                <div class="input-group">
                <div class="input-group-prepend" >
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                
                <select class="form-control">
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                    @endforeach
                    
                    
                </select>
                
                </div>
                <!-- /.input group -->
            </div>
        </div>
    </div>
    <!-- Modal Cliente -->
    @include("clients.modal")
    {{-- End Modal --}}

    @section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    @endsection
    @section('js')
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.css') }}">
    @endsection

</div>
