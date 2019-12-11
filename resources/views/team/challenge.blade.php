@extends('teamLayout.master')

@section('style')
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet"
    href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/sweetalert/sweetalert.css')}}" />
@endsection

@section('content')

@if(isset($challenge) && !is_null($challenge))
<div id="hintModal" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Pista</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tab-pane vivify flipInX">
                    <div class="pt-4 px-3">
                        <blockquote class="blockquote mb-0">
                            <h3 class="text-cyan">AYUDA</h3>
                            <p id="hintText"></p>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- larg modal -->
<div id="detailModalFlag" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Ingrese el flag</h5>
            </div>
            <div class="modal-body">
                <div class="tab-pane vivify flipInX" id="tabUserEdit">
                    <div class="pt-4 px-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <input id="flag" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <button id="btnFlag" type="button" class="btn btn-primary">OK</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card mt-5">
            <div class="body">
                <div id="slider2" class="carousel vert slide">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="card-value float-right text-muted"><i class="fa fa-key"></i></div>
                            <h3 class="mb-1">{{ $challenge->Challenge->Category->name }}</h3>
                            <p class="lead">{{ $challenge->Challenge->name }}</p>
                            <input type="hidden" value="{{ encrypt($challenge->id) }}" id="id_challenge">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="body">
                <blockquote class="blockquote mb-0">
                    <h4 class="text-cyan">DESCRIPCION</h4>
                    <p>{!! $challenge->Challenge->description !!}</p>
                </blockquote>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <form id="updateTeamForm" action="{{ route('teamschallenge.update') }}" method="POST">
            <div class="table-responsive">
                <table class="table table-hover table-custom spacing">
                    <thead>
                        <tr>
                            <th>NIVEL</th>
                            <th>RETO</th>
                            <th>RETO PUNTOS</th>
                            <th>PUNTOS CONSEGUIDOS</th>
                            <th class="text-center">PEDIR AYUDA</th>
                            <th class="text-center">ENVIAR FLAG</th>
                        </tr>
                    </thead>
                    <tbody id="tableChallenge">
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
@endif
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

@if(isset($challenge) && !is_null($challenge))
<script>
    var id_challenge = null;
    //Codigo AJX CONEXION DE PARTE DEL SERVIDOR
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        CargarReto();
        //esto es el ajax
    });

    function CargarReto() {
        $.ajax({
            type: "GET",
            url: "{{route('team.getLevelChallenges')}}",
            data: {
                _token: "{{ csrf_token() }}",
                id_challenge: $('#id_challenge').val()
            },
            dataType: "JSON",
            success: function (data) {
                if (data.challenges.length > 0) {
                    $('#tableChallenge').html('');
                    data.challenges.forEach(challenge => {
                        /* esto es para el flag del modal */
                        $('.mflag').on('click', function () {
                            $('#detailModalFlag').modal('show');
                        });
                        $('#tableChallenge').append(` <tr>
                        <td>
                            ${challenge.Level.name}
                        </td>
                        <td>
                            ${challenge.Challenge.name}
                        </td>
                        <td>
                            ${challenge.Level.score}
                        </td>
                        <td>
                            ${challenge.TeamChallenge !== null ? challenge.TeamChallenge.score : 0}
                        </td>
                        <td class="text-center">
                            <button id="hint_${challenge.id}" ${challenge.Challenge.hint === null ? 'disabled' : ''} type="button" data-score="${challenge.Level.score}" data-hint="${challenge.Level.hintDiscount}" data-id="${challenge.id}" class="btn ${challenge.TeamChallenge !== null ? (challenge.TeamChallenge.whithHint == 1 ? 'btn-info help-enabled' : 'btn-danger help-disabled') : 'btn-danger help-disabled'}">
                                <i class="fa ${challenge.Challenge.hint === null ? 'fa-ban' : (challenge.TeamChallenge !== null ? (challenge.TeamChallenge.whithHint == 1 ? 'fa-question' : 'fa-ambulance') : 'fa-ambulance')} fa-2x"></i>
                            </button>
                        </td>
                        <td class="text-center">
                            <button id="flag_${challenge.id}" data-id="${challenge.id}" type="button" class="btn ${challenge.TeamChallenge !== null ? (challenge.TeamChallenge.finish == 1 ? 'btn-success' : 'btn-primary mFlag') : 'btn-primary mFlag'}">
                                <i class="fa ${challenge.TeamChallenge !== null ? (challenge.TeamChallenge.finish == 1 ? 'fa-check' : 'fa-flag') : 'fa-flag'} fa-2x"></i>
                            </button>
                        </td>
                    </tr>`);
                    });
                }
            }
        });
    }

    $(document).on('click', '.help-enabled', function(e) {
        let button = $(this);
        let id_challenge = button.data('id');

        $.ajax({
            type: "GET",
            url: "{{ route('team.getHint') }}",
            data: {
                _token: '{{csrf_token()}}',
                id_challenge: id_challenge
            },
            dataType: "JSON",
            cache: false,
            success: function (response) {
                if(response.status) {
                    $('#hintText').html(response.hint);
                    $('#hintModal').modal('show');
                } else {
                    swal({
                        type: 'error',
                        title: 'Error',
                        text: response.msgError
                    })
                }
            },
            error: function(err) {
                console.log(err);
                swal({
                    type: 'error',
                    title: 'Error',
                    text: 'Error Desconocido'
                })
            }
        });
    });

    //final del document ready
    $(document).on('click', '.help-disabled', function (e) {

        let button = $(this);
        let id_challenge = button.data('id');

        let score = button.data('score');
        let hintDiscount = button.data('hint');

        let scoreDiscount = parseFloat(score) * parseFloat(hintDiscount);
        console.log(score, hintDiscount, scoreDiscount);

        swal({
            title: "¿Esta seguro?",
            text: "Al usar la ayuda, se te descontara " + scoreDiscount + " puntos a tu puntuación, logres o no el reto.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "Si, ayuda por favor!",
            closeOnConfirm: false,
            cancelButtonText: 'No no quiero yo puedo solo'
        }, function () {
            $.ajax({
                url: "{{ route('teamschallenge.update') }}",
                method: "POST",
                data: {
                    id_challenge: id_challenge,
                    _token: '{{csrf_token()}}'
                },
                dataType: "JSON",
                success: function (response) {
                    console.log(response);
                    if(response.status) {
                        swal({
                            type: 'success',
                            title: 'Felicidades',
                            text: 'Desbloqueaste la ayuda, usalo con sabiduria.'
                        });
                        $('#hintText').html(response.hint);
                        $('#hintModal').modal('show');
                        CargarReto();
                    } else {
                        swal({
                            type: 'error',
                            title: 'Error',
                            text: response.msgError
                        })
                    }
                },
                error: function (err) {
                    console.log(err);
                    swal({
                        type: 'error',
                        title: 'Error',
                        text: 'Error Desconocido'
                    })
                }
            });
        } /* funcion de mostrar el mensaje de confirmacion */) /* funcion que abarca el mensaje y sus atributos */;
    });

    $(document).on('click', '.mFlag', function() {
        let button = $(this);
        let challenge = button.data('id');

        id_challenge = challenge;

        let modal = $('#detailModalFlag');

        if(id_challenge === null || id_challenge === undefined) {
            swal({
                type: "error",
                title: "Error",
                text: "No se definio correctamente la bandera."
            })
            return;
        }

        modal.modal('show');
    });

    $(document).on('click','#btnFlag', function (e) {
        e.preventDefault();

        if(id_challenge === null || id_challenge === undefined) {
            swal({
                type: "error",
                title: "Error",
                text: "No se definio correctamente la bandera."
            })
            return;
        }

        let flag = $('#flag').val();

        if($.trim(flag) == "") {
            swal({
                type: "error",
                title: "Error",
                text: "La bandera es necesaria."
            })
            return;
        }

        $.ajax({
            url: "{{ route('challenge.flag')}}",
            method: "POST",
            data: {
                _token: '{{csrf_token()}}',
                id_challenge: id_challenge,
                flag: flag
            },
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                if (data.status) {
                    swal({
                        type: 'success',
                        title: 'Correcto',
                        text: 'La bandera coincide!'
                    });
                    window.location.href = "{{route('team.challenges')}}";
                } else {
                    swal({
                        type: 'error',
                        title: 'Error',
                        text: data.msgError
                    });
                }
            }
        });

    });

    $(document).on('hide.bs.modal', '#detailModalFlag', function() {
        $('#flag').val('');
    });

    $(document).on('hide.bs.modal', '#hintModal', function() {
        $('#hintText').html('');
    });
</script>
@endif
@endsection
