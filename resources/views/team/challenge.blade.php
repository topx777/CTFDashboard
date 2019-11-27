@extends('teamLayout.master') @section('style')
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet"
    href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/sweetalert/sweetalert.css')}}" /> @endsection @section('content')
<div class="col-lg-12">
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
    <form id="updateTeamForm" action="{{ route('teamschallenge.update') }}" method="POST">
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
    </form>
</div>
<!-- larg modal -->
<div id="detailModalFlag" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Ingrese el flag</h5>

            </div>

            <div class="modal-body">
                <div class="tab-pane vivify flipInX" id="tabUserEdit">
                    <div class="pt-4 px-3">
                        <form action="">
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <input name="tflag" id="flag" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <button id="btnFlag" type="button" class="btn btn-primary">OK</button>
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
@endsection @section('script')
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
    var id_challenge = '';
    //Codigo AJX CONEXION DE PARTE DEL SERVIDOR    
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "GET",
            url: "{{route('team.getLevelChallenges')}}",
            
            dataType: "JSON",
            success: function(data) {
                if (data.challenges.length > 0) {
                    $('#tableChallenge').html('');
                    data.challenges.forEach(challenge => {
                        /* esto es para el flag del modal */
                        $('.mflag').on('click', function() {
                            $('#detailModalFlag').modal('show');
                        });
                        $('#tableChallenge').append(` <tr>
                        <td class="w60">
                            ${challenge.id} 
                        </td>
                        <td>
                            ${challenge.name}
                        </td>
                        <td>
                            ${challenge.description}
                        </td>
                        <td>
                            <button id="${challenge.id}" type="button" onclick="update(this.id)" class="btn btn-danger help">
                                <i class="fa fa-ambulance fa-2x"></i>
                            </button>
                        </td>
                        <td>
                            <button id="${challenge.id}" onclick="setIdChallenge(this.id)" type="button" class="btn btn-primary mflag">
                                <i class="fa fa-flag"></i>    
                                -Enviar  
                            </button>
                        </td>
                    </tr>`);
                    });
                }
            }
        }); //esto es el ajax
    }); //final del document ready
    function update(id_challenge) {
        swal({
            title: "Esta seguro de usar tu ayuda",
            text: "Solo se puede usar una ayuda por reto",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "Si, ayuda por favor!",
            closeOnConfirm: false,
            cancelButtonText: 'No no quiero yo puedo solo'
        }, function() {
            var t = true;
            $.ajax({
                url: "{{ route('teamschallenge.update') }}",
                method: "POST",
                data: {
                    id_challenge: id_challenge,
                    _token: '{{csrf_token()}}'
                },
                dataType: "JSON",
                success: function(response) {
                    console.log(response);
                }
            });
            swal("Debil!", "Utilizaste la ayuda suerte!", "error");
        } /* funcion de mostrar el mensaje de confirmacion */ ) /* funcion que abarca el mensaje y sus atributos */ ;
    }

    $('#btnFlag').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('challenge.flag')}}",
            method: "POST",
            data: {
                _token: '{{csrf_token()}}',
                id_challenge: id_challenge,
                flag: $('#flag').val()
            },
            dataType: "JSON",
            success: function(data) {
                console.log(data);
            }
        });

    });

    function setIdChallenge(id) {
        id_challenge = id;
    }
</script>
@endsection