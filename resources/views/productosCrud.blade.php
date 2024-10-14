@extends('templateHeader')

@section('content')
<section class="feature_part padding_top">
    <div class="container">
        <h1>TABLA DE ADMINISTRACION DE PRODUCTOS</h1>
        <button class="genric-btn success">Agregar productos</button>
        <div class="ag-theme-alpine" style="height: 400px; width: 100%;">
            <div id="myGrid" style="width: 100%; height: 100%;"></div>
        </div>
    </div>
</section>

<script>
    // Convertimos los productos de Blade a JSON para usarlos en JavaScript
    const productos = @json($productos);

    document.addEventListener('DOMContentLoaded', function () {
        const gridOptions = {
            columnDefs: [
                { headerName: "ID", field: "idProductos", sortable: true, filter: true },
                { headerName: "Nombre", field: "Nombre", sortable: true, filter: true },
                { headerName: "Descripcion", field: "Descripcion", sortable: true, filter: true },
                {
                    headerName: "Acciones",
                    field: "acciones",
                    cellRenderer: function (params) {
                        return `
                            <button class="btn btn-sm btn-primary" onclick="editarProducto(${params.data.id})">Editar</button>
                            <button class="btn btn-sm btn-danger" onclick="eliminarProducto(${params.data.id})">Eliminar</button>
                        `;
                    }
                }
            ],
            rowData: productos,
            pagination: true,
            paginationPageSize: 10
        };

        // Crear la grid
        const gridDiv = document.querySelector('#myGrid');
        new agGrid.Grid(gridDiv, gridOptions);
    });
</script>
@endsection