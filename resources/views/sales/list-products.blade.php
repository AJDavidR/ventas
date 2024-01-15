<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-tshirt"></i> Productos</h3>
    </div>

    <div class="card-body">

        <x-table>

            <x-slot:thead>
                <th scope="col">#</th>
                <th scope="col"><i class="fas fa-image"></i></th>
                <th scope="col">Nombre</th>
                <th scope="col">Precio.vt</th>
                <th scope="col">Stock</th>
                <th scope="col">...</th>

            </x-slot>

            <tr>
                <td scope="row"></td>
                <td>
                    <img src="">

                </td>
                <td></td>
                <td></td>
                <td></td>
                <td>

                    <button class="btn btn-primary btn-sm" title="Agregar">
                        <i class="fas fa-plus-circle"></i>
                    </button>
                </td>

            </tr>

            <tr>
                <td colspan="10">Sin Registros</td>
            </tr>

        </x-table>

    </div>
    <div class="card-footer">

    </div>

</div>
