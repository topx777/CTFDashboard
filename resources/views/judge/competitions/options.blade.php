@extends('judgeLayout.master')
@section('style')
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet"
    href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/sweetalert/sweetalert.css')}}" />
<link rel="stylesheet" href="{{asset('vendor/summernote/dist/summernote.css')}}" />


<link rel="stylesheet" href="{{asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" />

<link rel="stylesheet" href="{{asset('vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css')}}" />

<link rel="stylesheet" href="{{asset('vendor/bootstrap-multiselect/bootstrap-multiselect.css')}}" />
<link rel="stylesheet" href="{{asset('vendor/multi-select/css/multi-select.css')}}" />
<link rel="stylesheet" href="{{asset('vendor/animate-css/vivify.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/toastr/toastr.min.css')}}">

@endsection
@section('content')

<div class="modal fade" id="linkModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h4 class="modal-title">Obtener Link Competencia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Link Competencia</label>
                    <div class="input-group">
                        <input class="form-control" id="linkCompetition" type="text" readonly
                            value="{{ route('login', ["ref" => app('request')->has('competition') ? app('request')->input('competition') : 0]) }}">
                        <div class="input-group-append">
                            <button id="copyClip" type="button" class="btn btn-primary" data-context="success"
                                data-message="Link Copiado al Clipboard" data-position="bottom-right">
                                <i class="fa fa-clipboard"></i>
                            </button>
                        </div>
                    </div>
                    <small class="text-muted">Puedes copiar el enlace de la competencia, para compartirlos con los
                        equipos</small>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="col-md-12">
    @if (!is_null($competition))
    <div class="col-md-12">
        <h3>Competencia: {{ $competition->name }}</h3>
    </div>
    <div class="col-md-12">
        <p class="lead">Acciones Competencia:</p>
    </div>
    <div class="col-md-12">
        <button id="resetCompetition" type="button" data-id="{{ $competition->id }}" class="btn btn-warning p-2 m-3">
            <i class="fa fa-fw fa-refresh"></i> Reiniciar Competencia
        </button>
        <button id="getLink" type="button" class="btn btn-primary p-2 m-3" data-toggle="modal" data-target="#linkModal">
            <i class="fa fa-fw fa-link"></i> Obtener Link de Competencia
        </button>
        <button id="deleteCompetition" type="button" data-id="{{ $competition->id }}" class="btn btn-danger p-2 m-3">
            <i class="fa fa-fw fa-trash"></i> Eliminar Competencia
        </button>
    </div>
    <div class="col-md-12">
        <p class="lead">Configuración de la competencia:</p>
    </div>
    <div class="col-md-12">
        <div id="formUpdCompetition" class="row clearfix maskedForm">
            <input type="hidden" id="id" value="{{ $competition->id }}">
            <div class="col-lg-6 col-md-6">
                <label><b>Nombre</b></label>
                <div class="input-group mb-3">
                    <input id="name" value="{{ $competition->name }}" placeholder="Nombre Competencia"
                        class="form-control name">
                    <div class="invalid-feedback">
                        El campo es obligatorio
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <label><b>Dificultad</b></label>
                <div class="input-group mb-3">
                    <select id="dificulty" class="form-control dificulty">
                        <option value="0" @if($competition->dificulty == 0) selected @endif>Facil</option>
                        <option value="1" @if($competition->dificulty == 1) selected @endif>Medio</option>
                        <option value="2" @if($competition->dificulty == 2) selected @endif>Dificil</option>
                        <option value="3" @if($competition->dificulty == 3) selected @endif>Extremo</option>
                    </select>
                    <div class="invalid-feedback">
                        El campo es obligatorio
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <label><b>Tipo de Desbloqueo Niveles</b></label>
                <div class="input-group mb-3">
                    <select id="unlockType" class="form-control unlockType">
                        <option value="0" @if($competition->unlockType == 0) selected @endif>Por Total Retos</option>
                        <option value="1" @if($competition->unlockType == 1) selected @endif>Por Nivel</option>
                    </select>
                    <div class="invalid-feedback">
                        El campo es obligatorio
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <label><b>Modo de Juego</b></label>
                <div class="input-group mb-3">
                    <select id="gameMode" class="form-control gameMode">
                        <option value="0" @if($competition->gameMode == 0) selected @endif>Modo Presencial</option>
                        <option value="1" @if($competition->gameMode == 1) selected @endif>Modo Remoto</option>
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
                        value="{{ Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $competition->startTime)->format('d/m/Y') }}"
                        data-provide="datepicker" placeholder="dd/mm/yyyy" data-date-autoclose="true"
                        class="form-control startTime" data-date-format="dd/mm/yyyy">
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
                        value="{{ Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $competition->startTime)->format('H:i') }}"
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
                        value="{{ Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $competition->endTime)->format('d/m/Y') }}"
                        placeholder="dd/mm/yyyy" data-provide="datepicker" data-date-autoclose="true"
                        class="form-control endTime" data-date-format="dd/mm/yyyy">
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
                        value="{{ Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $competition->endTime)->format('H:i') }}"
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
                            <input id="state" type="checkbox" {{ $competition->state ? 'checked' : '' }}>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 ml-5 mb-5 px-5 py-2">
                <button id="send" class="btn btn-success btn-round mr-4 ml-5 " type="button">Guardar</button>
                <button class="btn btn-danger btn-round ml-5" type="button">Cancelar</button>
            </div>
            <div class="col-md-12 col-lg-12">
                <h3>Reglas de juego</h3>
                <div class="card mt-3">
                    <div class="body">
                        <div class="summernote" id="rules">
                            {!! $competition->rules !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="col-md-12">
        <h3>No se encontro la competencia</h3>
    </div>
    @endif
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
<script src="{{asset('vendor/toastr/toastr.js') }}"></script>

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

            let formUpdCompetition = $('#formUpdCompetition');

            swal({
                title: "Esta seguro de modificar las opciones?",
                text: "Esta accion no se puede deshacer!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Si, modificar!",
                closeOnConfirm: false,
                cancelButtonText: 'Cancelar'
            }, function () {
                let form = new FormData();

                let id = $('#id').val();
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
                    url: "{{ route('competitions.update') }}",
                    data: form,
                    processData: false,
                    contentType: false,
                    dataType: "JSON",
                    success: function (response) {
                        if (response.status) {
                            swal({
                                type: 'success',
                                title: 'Correcto',
                                text: 'Configuraciones Actualizadas Correctamente'
                            });
                            setTimeout(function () {
                                window.location.href =
                                    "{{ route('judge.home') }}";
                            }, 1000);
                        } else {
                            if (response.validationErrors !== undefined) {
                                let keys = Object.keys(response.validationErrors);
                                let errors = response.validationErrors;
                                keys.forEach(key => {
                                    let node = $(formUpdCompetition).find(
                                        `.${key}`);
                                    if (node !== undefined) {
                                        node.addClass('is-invalid');
                                    }
                                    let errores = "";

                                    errors[`${key}`].forEach(error => {
                                        errores += error + '\n';
                                    });

                                    if (node !== undefined) {
                                        node.parent().find(
                                            '.invalid-feedback').html(
                                            errores);
                                    }
                                });
                            } else {
                                swal({
                                    type: 'error',
                                    title: 'Error',
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
        });

        $(document).on('keyup change', 'input', function () {
            let input = $(this);
            if (input.hasClass('is-invalid')) {
                input.removeClass('is-invalid');
            }
        });

        $(document).on('click', '#copyClip', function () {

            $context = $(this).data('context');
            $message = $(this).data('message');
            $position = $(this).data('position');

            if ($context === '') {
                $context = 'info';
            }

            if ($position === '') {
                $positionClass = 'toast-bottom-right';
            } else {
                $positionClass = 'toast-' + $position;
            }

            toastr.remove();
            toastr[$context]($message, '', {
                positionClass: $positionClass
            });

            copyToClipboard('#linkCompetition');
        });

        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).val()).select();
            document.execCommand("copy");
            $temp.remove();
        }


        $(document).on('click', '#resetCompetition', function () {

            let button = $(this);
            let id = button.data('id');

            swal({
                title: "Esta seguro que deseas reiniciar la competición?",
                text: "Esto reestablecera las puntuaciones de los equipos a 0",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Si, Reiniciar!",
                closeOnConfirm: false,
                cancelButtonText: 'Cancelar'
            }, function () {

                button.prop('disabled', true);

                $.ajax({
                    type: "POST",
                    url: "{{ route('competitions.reset') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    dataType: "JSON",
                    success: function (response) {
                        if (response.status) {
                            swal({
                                type: 'success',
                                title: 'Correcto',
                                text: 'Competencia Reiniciada Correctamente'
                            });
                        } else {
                            swal({
                                type: 'error',
                                title: 'Error',
                                text: response.msgError
                            });
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
        });


        $(document).on('click', '#deleteCompetition', function () {

            let button = $(this);
            let id = button.data('id');

            swal({
                title: "Esta seguro que deseas eliminar la competición?",
                text: "Esto eliminara completamente la competicion, los equipos, los niveles, las puntuaciones y los retos asignados",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Si, Eliminar!",
                closeOnConfirm: false,
                cancelButtonText: 'Cancelar'
            }, function () {

                button.prop('disabled', true);

                $.ajax({
                    type: "POST",
                    url: "{{ route('competitions.delete') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    dataType: "JSON",
                    success: function (response) {
                        if (response.status) {
                            swal({
                                type: 'success',
                                title: 'Correcto',
                                text: 'Competencia Eliminada Correctamente'
                            });
                            setTimeout(function () {
                                window.location.href =
                                    "{{ route('judge.home') }}";
                            }, 1000);
                        } else {
                            swal({
                                type: 'error',
                                title: 'Error',
                                text: response.msgError
                            });
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
        });

    });

</script>
@endsection
