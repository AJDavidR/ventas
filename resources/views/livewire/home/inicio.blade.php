<div>
    <x-card cardTitle="Bienvenid@s" cardFooter="">
        <x-slot:cardTools>
            <a href="{{ route("sales.list") }}" class="btn btn-primary">
                <i class="fas fa-shopping-cart"></i> Ir a ventas
            </a>
            <a href="{{ route("sales.create") }}" class="btn bg-purple">
                <i class="fas fa-cart-plus"></i> Crear ventas
            </a>
        </x-slot:cardTools>

        {{-- row cards ventas hoy --}}
        @include("home.row-cards-sales")

        {{-- Card grafica --}}
        @include("home.card-graph")

    </x-card>
