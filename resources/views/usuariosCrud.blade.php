@extends('templateHeader')

@section('content')
    <section class="feature_part padding_top">
        <div style="padding: 40px;">
            <h1>TABLA DE ADMINISTRACION DE USUARIOSS</h1>
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
                <div id="myGrid" style="width: full; height: 100%;"></div>
            </div>
        </div>

    </section>


    <script>
        // Convertimos los productos de Blade a JSON para usarlos en JavaScript
        const usuarios = @json($usuarios);

        document.addEventListener('DOMContentLoaded', function() {
            const gridOptions = {
                columnDefs: [{
                        headerName: "ID",
                        field: "idUsuario",
                        sortable: true,
                        filter: true,
                        flex: 2
                    },
                    {
                        headerName: "Usuario",
                        field: "Usuario",
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
                                <a href="/editarUsuario/${params.data.idUsuario}" class="btn btn-sm btn-primary">Editar</a>
                            `;
                        }
                    }
                ],
                rowData: usuarios,
                pagination: true,
                paginationPageSize: 10
            };


            // Crear la grid
            const gridDiv = document.querySelector('#myGrid');
            new agGrid.Grid(gridDiv, gridOptions);
        });
    </script>
@endsection
