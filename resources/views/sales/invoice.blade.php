<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura de Venta</title>

    <style>
        .r{
            border-radius: 5%;
        }
        .b{
            border: 1px solid black;
        }
        .shop-info{
            display: block;
            padding: 3px;
            font-size: 12.5px;
        }
        .factura-id{
            font-size: 1.5rem;
            font-style: normal;
            color: #525659;
        }
        .factura-fecha{
            font-size: 1rem;
            font-style: normal;
            color: #525659;
        }
        .productos{
            text-align: center;
            margin-top: 1rem;
        }
        .productos thead{
            background-color: #525659ab;
            color: white;
        }
        /* even es para seleccionar pares y odd para inpares */
        .productos tr:nth-child(even){
            background-color: #ddd;
        }
        th, td{
            padding: 10px;
        }
        .badge{
            background-color: #5256598d;
            color: white;
            padding: 3px;
            border-radius: 100%;
            width: 10px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <Table class="" width="100%" >
        <tr>
            {{-- Logo --}}
            <td width="25%">
                <img src="{{ public_path().'/'.'storage/'.$shop->image->url }}" alt="logo" width="150px" class="r">
            </td>

            {{-- Nombre y slogan --}}
            <td width="50%" style="text-align: center;">
                <h1>{{ $shop->name }}</h1>
                @if ($shop->slogan)
                    <p>{{ $shop->slogan }}</p>
                @endif
            </td>

            {{-- telefono, email, direccion, ciudad --}}
            <td width="25%">

                @if ($shop->telefono)
                    <span class="shop-info">
                        <b>Telefono: </b>{{ $shop->telefono }}
                    </span>
                @endif

                @if ($shop->email)
                    <span class="shop-info">
                        <b>Email: </b>{{ $shop->email }}
                    </span>
                @endif
                
                @if ($shop->direccion)
                    <span class="shop-info">
                        <b>Direccion: </b>{{ $shop->direccion }}
                    </span>
                @endif

                @if ($shop->ciudad)
                    <span class="shop-info">
                        <b>Ciudad: </b>{{ $shop->ciudad }}
                    </span>
                @endif
            </td>
        </tr>
    </Table>

    <table width="100%">
        <tr>

            <td width="33%" >

                <h2 style="margin-bottom: .5rem">Cliente:</h2>

                @if ($sale->client->name)
                    <span class="shop-info">
                        <b>Nombre: </b>{{ $sale->client->name }}
                    </span>
                @endif

                @if ($sale->client->identificacion)
                    <span class="shop-info">
                        <b>Identificacion: </b>{{ $sale->client->identificacion }}
                    </span>
                @endif

                @if ($sale->client->telefono)
                    <span class="shop-info">
                        <b>Telefono: </b>{{ $sale->client->telefono }}
                    </span>
                @endif

                @if ($sale->client->email)
                    <span class="shop-info">
                        <b>Email: </b>{{ $sale->client->email }}
                    </span>
                @endif

                @if ($sale->client->empresa)
                    <span class="shop-info">
                        <b>Empresa: </b>{{ $sale->client->empresa }}
                    </span>
                @endif

                @if ($sale->client->nit)
                    <span class="shop-info">
                        <b>Nit: </b>{{ $sale->client->nit }}
                    </span>
                @endif
            </td>
            <td width="33%" >

                <h2 style="margin-bottom: .5rem; text-align:center;">
                    Factura: <span class="factura-id">FV-{{ $sale->id }}</span>
                </h2>


            </td>
            <td width="33%" >

                <h3>
                    Fecha: <span class="factura-fecha">{{ $sale->created_at }}</span>
                </h3>

            </td>

        </tr>
    </table>

    <table width="100%" class="productos">
        <thead>
            <th>#</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Items</th>
            <th>Subtotal</th>
        </thead>

        <tbody>
            @forelse ($sale->items as $item)
                <tr>
                    <td>{{ ++$loop->index }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ money($item->price) }}</td>
                    <td>
                        <div class="badge">
                            {{ $item->qty }}
                        </div>
                    </td>
                    <td>
                        {{ money($item->price*$item->qty) }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Sin registros</td>
                </tr>
            @endforelse
        </tbody>
        <tr>
            <td colspan="3"></td>
            <td>Total: </td>
            <td>
                <b>{{ money($sale->total) }}</b>
            </td>
        </tr>
    </table>

    <table width="100%" style="text-align: center; margin-top: 5rem;">
        <tr>
            <td>
                ____________________________________ <br>
                <b>{{ $sale->user->name }}</b> <br>
                Vendedor
            </td>
        </tr>
    </table>

    <p style="text-align: center;">Muchas gracias por su compra!</p>

</body>
</html>