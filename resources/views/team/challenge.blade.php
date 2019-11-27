@extends('teamLayout.master')
@section('style')
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet"
    href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/sweetalert/sweetalert.css')}}" />
@endsection
@section('content')
<!-- larg modal -->
<div id="detailModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Detalle de Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <ul class="nav nav-tabs2 justify-content-end">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab"
                            href="#tabUserDetail">Detalle</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabUserEdit">Editar</a></li>
                    <li id="btnUserDelete" class="nav-item"><a class="nav-link">Eliminar</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show vivify flipInX active" id="tabUserDetail">
                        <div class="row pt-4 px-3">
                            <div class="col-6 form-group">
                                <strong class="text-white">Username:</strong>
                                <span class="">username</span>
                            </div>
                            <div class="col-6 form-group">
                                <strong class="text-white">Administrador:</strong>
                                <label class="fancy-radio custom-color-green"><input name="gender4" value="female"
                                        type="radio" checked="" disabled=""><span><i></i></span></label>
                            </div>
                            <div class="col-6 form-group">
                                <strong class="text-white">Email:</strong>
                                <span class="">miemail@ctf.comsegserwgrtw</span>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane vivify flipInX" id="tabUserEdit">
                        <div class="pt-4 px-3">
                            <form action="">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Username</label>
                                            <input name="userData[username]" autofocus type="text" class="form-control"
                                                required maxlength="40">
                                            <div class="invalid-feedback">
                                                El campo username es obligatorio
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <br>
                                            <div class="fancy-checkbox">
                                                <label><input name="admin"
                                                        type="checkbox"><span>Administrador</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Password</label>
                                            <input name="password" type="password" value="userpass" class="form-control"
                                                required maxlength="35">
                                            <div class="invalid-feedback">
                                                El campo password es obligatorio
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input name="email" type="email" class="form-control" required
                                                maxlength="55">
                                            <div class="invalid-feedback">
                                                El campo email es obligatorio
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
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
            <h2>Lista de Retos
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
                },  
                {
                    data: 'DT_RowId',
                    name: 'DT_RowId',
                    visible: false
                }]
            });
        }) //final del document ready
</script>
@endsection