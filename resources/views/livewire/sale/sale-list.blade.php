<div>
    <x-card cardTitle="Listado ventas ({{ $totalRegistros }})">
        <x-slot:cardTools>

            <div class="d-flex align-items-center ">
                <span class="badge badge-info" style="font-size: 1.2rem">
                    Total: {{ money($this->totalVentas) }}
                </span>

                {{-- selector de fechas --}}
                <div class="mx-2">
                    {{-- {{ $dateInicio. ' - ' . $dateFinal }} --}}
                    <button class="btn btn-default" id="daterange-btn" wire:ignore>
                        <i class="fas fa-calendar-alt"></i>
                        <span>
                            A-M-D - A-M-D
                        </span>
                        <i class="fas fa-caret-down"></i>

                    </button>
                </div>

                {{-- boton crear venta --}}
                <a href="{{ route('sales.create') }}" class="btn btn-primary">
                    <i class="fas fa-cart-plus"></i>
                    Crear venta
                </a>
            </div>

        </x-slot>

        <x-table>
            <x-slot:thead>
                <th>ID</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Productos</th>
                <th>Articulos</th>
                <th>Fecha</th>
                <th width="3%">...</th>
                <th width="3%">...</th>
                <th width="3%">...</th>
                <th width="3%">...</th>

            </x-slot>

            @forelse ($sales as $sale)
                <tr>
                    <td>
                        <span class="badge badge-primary">
                            FV--{{ $sale->id }}
                        </span>
                    </td>
                    <td>{{ $sale->client->name }}</td>
                    <td>
                        <span class="badge badge-secondary">
                            {{ money($sale->total) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-pill bg-purple">
                            {{ $sale->items->count() }}
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-pill bg-purple">
                            {{ $sale->items->sum('pivot.qty') }}
                        </span>
                    </td>
                    <td>{{ $sale->fecha }}</td>
                    {{-- Botones --}}
                    <td>
                        <a href="" class="btn bg-navy btn-sm" title="Generar PDF">
                            <i class="fas fa-file-pdf fa-lg"></i>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('sales.show', $sale) }}" class="btn btn-success btn-sm" title="Ver">
                            <i class="far fa-eye"></i>
                        </a>
                    </td>
                    <td>
                        <a href="#" wire:click='edit({{ $sale->id }})' class="btn btn-primary btn-sm"
                            title="Editar">
                            <i class="far fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <a wire:click="$dispatch('delete',{id: {{ $sale->id }}, eventName:'destroySale'})"
                            class="btn btn-danger btn-sm" title="Eliminar">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>

            @empty

                <tr class="text-center">
                    <td colspan="10">Sin registros</td>
                </tr>
            @endforelse

        </x-table>

        <x-slot:cardFooter>
            {{ $sales->links() }}

        </x-slot>
    </x-card>

    @section('styles')
        <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    @endsection
    @section('js')
        <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
        <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>


        <script>
            $('#daterange-btn').daterangepicker({
                    ranges: {
                        'Default': [moment().startOf('year'), moment()],
                        'Hoy': [moment(), moment()],
                        'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Ultimos 7 Dias': [moment().subtract(6, 'days'), moment()],
                        'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
                        'Este Mes': [moment().startOf('month'), moment().endOf('month')],
                        'Ultimos Mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                            'month')]
                    },
                    startDate: moment().startOf('year'),
                    endDate: moment()
                },
                function(start, end) {
                    dateStart = start.format('YYYY-MM-DD');
                    dateEnd = end.format('YYYY-MM-DD');

                    $('#daterange-btn span').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));

                    Livewire.dispatch("setDates", {
                        fechaInicio: dateStart,
                        fechaFinal: dateEnd,
                    })
                }
            );
        </script>
    @endsection

</div>
