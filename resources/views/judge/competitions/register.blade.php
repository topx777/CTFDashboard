@extends('judgeLayout.master')
@section('style')
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet"href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/sweetalert/sweetalert.css')}}" />
<link rel="stylesheet" href="{{asset('vendor/summernote/dist/summernote.css')}}" />


<link rel="stylesheet" href="{{asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}"/>

<link rel="stylesheet" href="{{asset('vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css')}}"/>

<link rel="stylesheet" href="{{asset('vendor/bootstrap-multiselect/bootstrap-multiselect.css')}}"/>
<link rel="stylesheet" href="{{asset('vendor/multi-select/css/multi-select.css')}}"/>

@endsection
@section('content')
<div class="col-md-12">
    <div id="formRegCompetition" class="row clearfix maskedForm">
        <div class="col-md-12">
            <h3>Registrar Nueva Competencia</h3>
            <p class="lead">Configuración de la competencia:</p>
        </div>
        <div class="col-lg-6 col-md-6">
            <label><b>Nombre</b></label>
            <div class="input-group mb-3">
                <input id="name"
                    placeholder="Nombre Competencia" class="form-control name">
                <div class="invalid-feedback">
                    El campo es obligatorio
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <label><b>Dificultad</b></label>
            <div class="input-group mb-3">
                <select id="dificulty" class="form-control dificulty">
                    <option value="0">Facil</option>
                    <option value="1">Medio</option>
                    <option value="2">Dificil</option>
                    <option value="3">Extremo</option>
                </select>
                <div class="invalid-feedback">
                    El campo es obligatorio
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <label><b>Tipo de Desbloqueo Niveles</b></label>
            <div class="input-group mb-3">
                <select id="unlockType" class="form-control dificulty">
                    <option value="0">Por Total Retos</option>
                    <option value="1">Por Nivel</option>
                </select>
                <div class="invalid-feedback">
                    El campo es obligatorio
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <label><b>Modo de Juego</b></label>
            <div class="input-group mb-3">
                <select id="gameMode" class="form-control dificulty">
                    <option value="0">Modo Presencial</option>
                    <option value="1">Modo Remoto</option>
                </select>
                <div class="invalid-feedback">
                    El campo es obligatorio
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <label><b>Fecha de Inicio</b></label>
            <div class="input-group mb-3">
                <input id="dateStart"
                    data-provide="datepicker" placeholder="dd/mm/yyyy" data-date-autoclose="true" class="form-control startTime"
                    data-date-format="dd/mm/yyyy">
                <div class="invalid-feedback">
                    El campo es obligatorio
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <label><b>Hora de Inicio</b></label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="icon-clock"></i></span>
                </div>
                <input id="timeStart"
                    type="text" class="form-control time24 startTime" placeholder="Ex: 23:59">
                <div class="invalid-feedback">
                    El campo es obligatorio
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <label><b>Fecha de Fin</b></label>
            <div class="input-group mb-3">
                <input id="dateEnd"
                    placeholder="dd/mm/yyyy" data-provide="datepicker" data-date-autoclose="true" class="form-control endTime"
                    data-date-format="dd/mm/yyyy">
                <div class="invalid-feedback">
                    El campo es obligatorio
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <label><b>Hora Fin</b></label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="icon-clock"></i></span>
                </div>
                <input id="timeEnd"
                    type="text" class="form-control time24 endTime" placeholder="Ex: 23:59">
                <div class="invalid-feedback">
                    El campo es obligatorio
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-5 m-0 p-0 mb-5">
            <div class="list-group-item">
                Estado de la competencia
                <div class="float-right">
                    <label class="switch">
                        <input id="state" type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
        <input type="hidden" id="idJudge" value="{{ auth()->user()->Judge->id }}">
        <div class="col-lg-6 col-md-6 ml-5 mb-5 px-5 py-2">
            <button id="send" class="btn btn-success btn-round mr-4 ml-5 " type="button">Guardar</button>
            <button class="btn btn-danger btn-round ml-5" type="button">Cancelar</button>
        </div>
        <div class="col-md-12 col-lg-12">
            <h3>Reglas de juego</h3>
            <div class="card mt-3">
                <div class="body">
                    <div class="summernote" id="rules">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- larg modal -->

@endsection
@section('script')
<script src="{{asset('bundles/libscripts.bundle.js')}}"></script>
<script src="{{asset('bundles/vendorscripts.bundle.js')}}"></script>
<script src="{{asset('vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js')}}"></script>

<script src="{{asset('vendor/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>

<script src="{{asset('vendor/jquery.maskedinput/jquery.maskedinput.min.js')}}"></script>
<script src="{{asset('vendor/multi-select/js/jquery.multi-select.js')}}"></script>

<script src="{{asset('vendor/bootstrap-multiselect/bootstrap-multiselect.js')}}"></script>
<script src="{{asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

<script src="{{asset('vendor/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>

<script src="{{asset('bundles/mainscripts.bundle.js')}}"></script>

<script src="{{asset('bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('vendor/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('vendor/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('vendor/jquery-datatable/buttons/buttons.print.min.js')}}"></script>
<script src="{{asset('vendor/sweetalert/sweetalert.min.js')}}"></script><!-- SweetAlert Plugin Js -->
{{-- <script src="{{asset('js/pages/tables/jquery-datatable.js')}}"></script> --}}
<script src="{{asset('js/pages/ui/dialogs.js')}}"></script>
<script src="{{asset('vendor/summernote/dist/summernote.js')}}"></script>



<script>
    $(document).ready(function () {

        $('#rules').summernote();

        var $demoMaskedInput = $('.maskedForm');
        $demoMaskedInput.find('.date').inputmask('dd/mm/yyyy', {
            placeholder: '__/__/____'
        });
        $demoMaskedInput.find('.time12').inputmask('hh:mm t', {
            placeholder: '__:__ _m',
            alias: 'time12',
            hourFormat: '12'
        });
        $demoMaskedInput.find('.time24').inputmask('hh:mm', {
            placeholder: '__:__ _m',
            alias: 'time24',
            hourFormat: '24'
        });
        $demoMaskedInput.find('.datetime').inputmask('d/m/y h:s', {
            placeholder: '__/__/____ __:__',
            alias: "datetime",
            hourFormat: '24'
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '#send', function () {
            let button = $(this);

            let formRegCompetition = $('#formRegCompetition');

            let form = new FormData();

            let id = $('#id').val();
            let idJudge = $('#idJudge').val();
            let name = $('#name').val();
            let dificulty = $('#dificulty').val();
            let unlockType = $('#unlockType').val();
            let gameMode = $('#gameMode').val();
            let startTime = $('#dateStart').val() + ' ' + $('#timeStart').val();
            let endTime = $('#dateEnd').val() + ' ' + $('#timeEnd').val();
            let state = $('#state').prop('checked') ? 1 : 0;
            let rules = $('#rules').summernote('code');

            form.append('_token', "{{ csrf_token() }}");
            form.append('id', id);
            form.append('idJudge', idJudge);
            form.append('name', name);
            form.append('dificulty', dificulty);
            form.append('unlockType', unlockType);
            form.append('gameMode', gameMode);
            form.append('startTime', startTime);
            form.append('endTime', endTime);
            form.append('state', state);
            form.append('rules', rules);

            button.prop('disabled', true);

            $.ajax({
                type: "POST",
                url: "{{ route('competitions.store') }}",
                data: form,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function (response) {
                    console.log(response);
                    if(response.status) {
                        swal({
                            type: 'success',
                            title: 'Correcto',
                            text: 'Configuraciones Actualizadas Correctamente'
                        });
                        setTimeout(function() {
                            window.location.href = "{{ route('judge.home') }}";
                        },1000);
                    } else {
                        if (response.validationErrors !== undefined) {
                            let keys = Object.keys(response.validationErrors);
                            let errors=response.validationErrors;
                            keys.forEach(key => {
                                let node = $(formRegCompetition).find(`.${key}`);
                                if(node !== undefined) {
                                    node.addClass('is-invalid');
                                }
                                let errores = "";

                                errors[`${key}`].forEach(error => {
                                    errores +=error + '\n';
                                });

                                if(node !== undefined) {
                                    node.parent().find('.invalid-feedback').html(errores);
                                }
                            });
                        } else {
                            swal({
                                type: 'error',
                                title:'Error',
                                text: response.msgError
                            });
                        }
                    }
                },
                error: function (err) {
                    console.log(err);
                    swal({
                        type: 'error',
                        title: 'Error',
                        text: 'Error Desconocido'
                    });
                },
                complete: function () {
                    button.prop('disabled', false);
                }
            });

        });

        $(document).on('keyup change', 'input', function() {
            let input = $(this);
            if(input.hasClass('is-invalid')) {
                input.removeClass('is-invalid');
            }
        });
    });
</script>
@endsection
