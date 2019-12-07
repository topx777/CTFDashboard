@extends('adminLayout.master')
@section('style')
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet"
    href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/sweetalert/sweetalert.css')}}" />
@endsection
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="header">
            <h2>Lista de retos en CTF<small>Seleccione un item para ver detalles</small>
            </h2>
            <ul class="header-dropdown dropdown">
                <li><a href="{{ route('challenges.register') }}" class="btn btn-primary text-white">Registrar</a></li>
                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a>
                </li>
            </ul>
        </div>
        <div class="body">
            <div class="table-responsive">
                <table class="table table-striped table-hover dataTable js-exportable">
                    <thead>
                        <tr>
                            <th> </th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Pista</th>
                            <th>Nivel</th>
                            <th>Categoria</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th> </th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Pista</th>
                            <th>Nivel</th>
                            <th>Categoria</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('vendor/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('vendor/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('vendor/jquery-datatable/buttons/buttons.print.min.js')}}"></script>
<script src="{{asset('vendor/sweetalert/sweetalert.min.js')}}"></script><!-- SweetAlert Plugin Js -->
{{-- <script src="{{asset('js/pages/tables/jquery-datatable.js')}}"></script> --}}
<script src="{{asset('js/pages/ui/dialogs.js')}}"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.dataTable').DataTable({
            language: {
                url: "{{asset('lenguage/Spanish.json')}}"
            },
            processing: true,
            serverSide: true,
            ajax: "{{ route('challenges.list') }}",
            columns: [
                { data: 'action', name: 'action'},
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description' },
                { data: 'hint', name: 'hint' },
                { data: 'idLevel', name: 'idLevel' },
                { data: 'idCategory', name: 'idCategory' },
                { data: 'DT_RowId', name: 'DT_RowId', visible: false }
            ]
        });

        // confirm delete user
        $(document).on('click', '.deleteChallenge', function (e) {
            e.preventDefault();
            let button = $(this);
            let id = button.data('id');

            swal({
                title: "Esta seguro de eliminar el reto?",
                text: "Esta accion no se puede deshacer!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Si, eliminar!",
                closeOnConfirm: false,
                cancelButtonText: 'Cancelar'
            }, function () {

                button.prop('disabled', true);

                $.ajax({
                    type: "POST",
                    url: "{{ route('challenges.delete') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    cache: false,
                    dataType: "JSON",
                    success: function (response) {
                        if(response.status) {
                            swal("Correcto!", "Reto Eliminado Correctamente", "success");
                            table.ajax.reload();
                        } else {
                            swal("Error!", response.msgError, "error");
                        }
                    },
                    error: function(err) {
                        console.log(err);
                        swal("Error!", "Error Desconocido", "error");
                    },
                    complete: function() {
                        button.prop('disabled', false);
                    }
                });

            });

        });

    });
</script>
@endsection
