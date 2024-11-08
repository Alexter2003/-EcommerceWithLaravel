@extends('templateHeader')

@section('content')
    <section class="feature_part padding_top">
        <div style="padding: 40px;">
            <h1>TABLA DE ADMINISTRACION DE CATEGORIAS</h1>
            <a class="genric-btn success" href="/crearCategoria" style="margin-top: 10px; margin-bottom: 10px;">
                Agregar categoria
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
                <div id="myGrid" style="width: full; height: 100%;"></div>
            </div>
        </div>

        <!-- Modal de confirmación -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
            aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar eliminación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que quieres desactivar esta categoria? Si lo hace, todos los productos con esta
                        categoria
                        dejaran de aparecer
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <form id="deleteCategoriasForm" action="" method="POST" style="display: inline;">
                            @method('PATCH')
                            @csrf
                            <button type="submit" class="btn btn-danger">Desactivar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        // Convertimos los productos de Blade a JSON para usarlos en JavaScript
        const categorias = @json($categorias);

        document.addEventListener('DOMContentLoaded', function() {
            const gridOptions = {
                columnDefs: [{
                        headerName: "ID",
                        field: "idCategorias",
                        sortable: true,
                        filter: true,
                        flex: 2
                    },
                    {
                        headerName: "Nombre",
                        field: "Nombre",
                        sortable: true,
                        filter: true,
                        flex: 200
                    },
                    {
                        headerName: "Descripcion",
                        field: "Descripcion",
                        sortable: true,
                        filter: true,
                        flex: 200
                    },
                    {
                        headerName: "Estado",
                        field: "Estado",
                        sortable: true,
                        filter: true,
                        width: 150,
                        cellRenderer: function(params) {
                            // Verifica el valor de 'Estado' (1 o 0)
                            if (params.data.Estado === 1) {
                                return '<span class="badge badge-success">Activo</span>'; // Etiqueta activa
                            } else {
                                return '<span class="badge badge-danger">Inactivo</span>'; // Etiqueta inactiva
                            }
                        }
                    },
                    {
                        headerName: "Acciones",
                        field: "acciones",
                        width: 200,
                        cellRenderer: function(params) {
                            let deleteButton = '';
                            if (params.data.Estado !== 0) {
                                deleteButton = `
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmDeleteModal" 
                                        data-id="${params.data.idCategorias}">Eliminar</button>
                                `;
                            }

                            return `
                                <a href="/editarCategoria/${params.data.idCategorias}" class="btn btn-sm btn-primary">Editar</a>
                                ${deleteButton}
                            `;
                        }
                    }
                ],
                rowData: categorias,
                pagination: true,
                paginationPageSize: 10
            };


            // Crear la grid
            const gridDiv = document.querySelector('#myGrid');
            new agGrid.Grid(gridDiv, gridOptions);
        });

        document.addEventListener('DOMContentLoaded', function() {
            $('#confirmDeleteModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Botón que activó el modal
                var categoriaId = button.data('id'); // Obtener el ID del producto
                var actionUrl = '/eliminarMarca/' + categoriaId; // Crear la URL de eliminación

                // Establecer la acción del formulario al URL adecuado
                $('#deleteCategoriasForm').attr('action', actionUrl);
            });
        });
    </script>
@endsection
