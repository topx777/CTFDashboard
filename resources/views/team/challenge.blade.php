@extends('teamLayout.master')
@section('style')
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet"
    href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/sweetalert/sweetalert.css')}}" />
@endsection
@section('content')
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
<div class="col-lg-12">
    <div class="table-responsive">
        <table class="table table-hover table-custom spacing8">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Ayuda</th>
                    <th>flag</th>
                </tr>
            </thead>
            <tbody id="tableChallenge">

            </tbody>
        </table>
    </div>
</div>
<!-- larg modal -->
<div id="detailModalHelp" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
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

            $.ajax({
                type: "GET",
                url: "{{route('team.tshowChallenge')}}",
                dataType: "JSON",
                success: function (data) {
                    if (data.challenges.length>0) {
                        $('#tableChallenge').html('');
                        var i=0;
                        data.challenges.forEach(challenge => {
                        $('.help').click(function (e) {
                            e.preventDefault();
                            showConfirmMessage();

                        });
                        function showConfirmMessage() {
                            swal({
                                title: "Esta seguro de usar tu ayuda",
                                text: "Solo se puede usar una ayuda por reto",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#dc3545",
                                confirmButtonText: "Si, ayuda por favor!",
                                closeOnConfirm: false,
                                cancelButtonText: 'No no quiero yo puedo solo'
                            }, function () {
                                swal("Debil!", "Utilizaste la ayuda suerte!", "success");
                            });
                        }
                            /* esto es para el flag del modal */
                            $('.flag').on('click',function () {
                            $('#detailModalFlag').modal('show');});
                            /* esto es para llenar la tabla */
                            i+=1;
                            $('#tableChallenge').append(` <tr>
                        <td class="w60">
                            ${i} 
                        </td>
                        <td>
                            ${challenge.name}
                        </td>
                        <td>
                            ${challenge.description}
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger help">
                                <i class="fa fa-ambulance fa-2x"></i>
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-primary">
                                <i class="fa fa-flag"></i>    
                                -Enviar  
                            </button>
                        </td>
                    </tr>`);
                    });
                    }
                }
            });//esto es el ajax
        }); //final del document ready

</script>
@endsection