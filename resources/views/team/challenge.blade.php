@extends('teamLayout.master') @section('style')
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet"
    href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/sweetalert/sweetalert.css')}}" /> @endsection @section('content')

<div class="col-lg-6">
    <div class="card">
        <div class="body">
            <div id="slider2" class="carousel vert slide" data-ride="carousel" data-interval="1700">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="card-value float-right text-muted"><i class="fa fa-signal"></i></div>
                        <h3 class="mb-1">NIVEL</h3>
                    </div>
                    <div class="carousel-item">
                        <div class="card-value float-right text-muted">
                            <h3 class="mb-1">
                                <I class="fa fa-key"></I>
                            </h3>
                        </div>
                        <h3>Uno</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-6">
    <div class="card">
        <div class="body">
            <div id="slider2" class="carousel vert slide" data-ride="carousel" data-interval="1700">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="card-value float-right text-muted"><i class="fa fa-key"></i></div>
                        <h3 class="mb-1">CRIPTOGRAFIA</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="body">
        <blockquote class="blockquote mb-0">
            <p>El reto consiste en saber cuanto se enbolsillo el evo con el juancito pinto gobierno para los ninos con
                el bomo jauncito pinto es para escuelas fiscales</p>
        </blockquote>
    </div>
</div>
<div class="col-lg-6">
    <div class="card">
        <div class="header">
            <h2>Lista de Categorias<small>Seleccione una fila para ver detalles</small>
            </h2>
            <ul class="header-dropdown dropdown">
                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a>
                </li>
            </ul>
        </div>
        <div class="body">
            <div class="table-responsive">
                <table class="table table-striped table-hover dataTable js-exportable">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Nivel</th>
                            <th scope="col">Ayuda</th>
                            <th scope="col">Bandera</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Nivel</th>
                            <th scope="col">Ayuda</th>
                            <th scope="col">Bandera</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <button class="btn btn-danger">
                                    <i class="fa fa-ambulance fa-2x"></i>
                                </button>
                            </td>
                            <td><button class="btn btn-primary">
                                    <i class="fa fa-flag"></i>
                                    -Enviar
                                </button></td>
                        </tr>
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
<script src="{{asset('vendor/sweetalert/sweetalert.min.js')}}"></script>
<!-- SweetAlert Plugin Js -->
{{--
<script src="{{asset('js/pages/tables/jquery-datatable.js')}}"></script> --}}
<script src="{{asset('js/pages/ui/dialogs.js')}}"></script>

<script>
    //Codigo AJX CONEXION DE PARTE DEL SERVIDOR
    $(document).ready(function() {
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
                ajax: "{{ route('team.tshowChallenge') }}",
                columns: [{
                    data: 'name',
                    name: 'name'
                }, {
                    data: 'description',
                    name: 'description'
                }, {
                    data: 'order',
                    name: 'order'
                }, {
                    data: 'DT_RowId',
                    name: 'DT_RowId',
                    visible: false
                }]
            });
        }) //final del document ready
</script>
@endsection