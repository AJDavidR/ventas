<div class="card">
    <div class="px-3 d-flex justify-content-between align-items-center">
        <div>
            <div>
                {{ Auth::user()->name }}
                ( {{ config('app.name', 'Laravel') }} )
            </div>
            <div>
                {{ \Carbon\Carbon::now()->format('d-m-Y, H:i:s') }}
            </div>
        </div>

        {{-- tabla --}}
        <div class="d-flex">
            <div class="d-flex flex-column align-items-center border border-white">
                <div class="">
                    Subtotal: <b>{{ money($total) }}</b>
                </div>
                <div class="border-top border-white mx-2">
                    Retenciones: <b>$0</b>
                </div>
            </div>
        
            <div class="d-flex flex-column align-items-center border border-white">
                <div class="">
                    Iva: <b>$0</b>
                </div>
                <div class="border-top border-white mx-2">
                    Inc: <b>$0</b>
                </div>
            </div>
        
            <div class="d-flex align-items-center border border-white p-2">
                <h3>
                    <span class="">Total: <b>{{ money($total) }}</b></span>
                </h3>
            </div>
        </div>
        
        {{-- btn --}}
        <div>
            <a href="#" class="btn btn-danger btn-sm align-middle" wire:click='cancel'>
                <i class="fas fa-trash mr-1"></i> Cancelar venta
            </a>
        </div>
    </div>
</div>
