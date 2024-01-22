<div class="card">
    <div class="card-header">
        <button type="button" class="btn btn-primary position-relative mr-3 float-left">
            Nuevo pedido
        </button>
        <button type="button" class="btn btn-primary position-relative mr-3 float-left">
            Pedidos Activos
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                99+
            </span>
        </button>
        <button type="button" class="btn btn-primary position-relative mr-3 float-left">
            Comandas
        </button>

        <a href="#" class="btn btn-secondary btn-sm float-right mr-2">
            <i class="fas fa-keyboard"></i>
        </a>
        <a href="#" class="btn btn-secondary btn-sm float-right mr-2">
            <i class="fas fa-cash-register"></i>
        </a>
    </div>
    <div class="card-body">
        {{-- CONTENT --}}
        <div class="row">
            {{-- Columna productos --}}
            <div class="col-md-7">
                {{-- List of products --}}
                @include('salesB.list-productsB')
            </div>
            {{-- Detalles de la venta --}}
            <div class="col-md-5">
                {{-- Card details --}}
                @include('salesB.card-detailsB')
            </div>
        </div>
    </div>
    <div class="main-footer">
        <div class="px-3">
            {{-- Card pago --}}
            @include('salesB.card-pagoB')
        </div>
    </div>
</div>
