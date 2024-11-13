@extends('templateHeader')

@section('content')
    <section class="feature_part padding_top">
        <div style="padding: 40px;">
            <h1>TABLA DE ADMINISTRACION DE EXISTENCIAS</h1>
            <a class="genric-btn success" href="/crearExistenciaInventario" style="margin-top: 10px; margin-bottom: 10px;">
                Agregar Inventario
            </a>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="ag-theme-alpine" style="height: 400px; width: 100%;">
                <div class="single-element-widget mt-30" style="margin-bottom: 30px;">
                    <h5>Sucursal</h5>
                    <div class="default-select" id="default-select_2">
                        <select name="idSucursal" id="sucursalSelector" onchange="redirectToSucursal()">
                            @foreach ($sucursales as $sucursal)
                                <option value="{{ $sucursal->idSucursal }}"
                                    {{ $sucursal->idSucursal == $idSucursalSeleccionada ? 'selected' : '' }}>
                                    {{ $sucursal->Nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="ag-theme-alpine" style="height: 400px; width: 100%;">
                    <div id="myGrid" style="width: full; height: 100%;"></div>
                </div>
            </div>
        </div>

    </section>


    <script>
        // Convertimos los productos de Blade a JSON para usarlos en JavaScript
        const inventario = @json($inventario);

        document.addEventListener('DOMContentLoaded', function() {
            const gridOptions = {
                columnDefs: [{
                        headerName: "ID",
                        field: "idInventarios_Productos",
                        sortable: true,
                        filter: true,
                        flex: 2
                    },
                    {
                        headerName: "Sucursal",
                        field: "Sucursal",
                        sortable: true,
                        filter: true,
                        flex: 200
                    },
                    {
                        headerName: "Producto",
                        field: "Producto",
                        sortable: true,
                        filter: true,
                        flex: 200
                    },
                    {
                        headerName: "Cantidad",
                        field: "Cantidad",
                        sortable: true,
                        filter: true,
                        flex: 200
                    },
                    {
                        headerName: "FechaCompra",
                        field: "FechaCompra",
                        sortable: true,
                        filter: true,
                        flex: 200
                    },
                    {
                        headerName: "Lote",
                        field: "Lote",
                        sortable: true,
                        filter: true,
                        flex: 200
                    },
                    {
                        headerName: "Acciones",
                        field: "acciones",
                        width: 200,
                        cellRenderer: function(params) {
                            return `
                                <a href="/editarMarca/${params.data.idMarcas}" class="btn btn-sm btn-primary">Agregar existencia</a>
                            `;
                        }
                    }
                ],
                rowData: inventario,
                pagination: true,
                paginationPageSize: 10
            };


            // Crear la grid
            const gridDiv = document.querySelector('#myGrid');
            new agGrid.Grid(gridDiv, gridOptions);
        });

        document.getElementById('sucursalSelector').addEventListener('change', function() {
            const idSucursal = this.value;
            window.location.href = `/crudInventarioProducto/${idSucursal}`;
        });

        function redirectToSucursal() {
            const idSucursal = document.getElementById('sucursalSelector').value;
            if (idSucursal) {
                window.location.href = `/crudInventarioProducto/${idSucursal}`;
            }
        }
    </script>
@endsection
