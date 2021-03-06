@extends('judgeLayout.master')
@section('style')
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet"
    href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/sweetalert/sweetalert.css')}}" />
<style>
    tbody tr {
        cursor: pointer;
    }
</style>
@endsection
@section('content')
<!-- level list -->
<div class="col-lg-12">
    <div class="card">
        <div class="header">
            <h2>Lista de Niveles<small>Seleccione una fila para ver detalles</small>
            </h2>
            <ul class="header-dropdown dropdown">
                <li><a data-toggle="modal" data-target="#registerlevelModal"
                        class="btn btn-primary text-white">Registrar</a></li>
                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a>
                </li>
            </ul>
        </div>
        <div class="body">
            <div class="table-responsive">
                <table id="levelTable" class="table table-striped table-hover dataTable js-exportable">
                    <thead>
                        <tr>
                            <th>Nivel</th>
                            <th>Puntos</th>
                            <th>Porcentaje descuento</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nivel</th>
                            <th>Puntos</th>
                            <th>Porcentaje descuento</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Register level modal -->
<div id="registerlevelModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Nuevo Nivel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tab-pane vivify flipInX">
                    <div class="pt-4 px-3">
                        <form id="registerLevelForm" action="{{ route('levels.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Nombre nivel</label>
                                        <input name="name" autofocus type="text" class="form-control" required
                                            autocomplete="false" maxlength="25">
                                        <div class="invalid-feedback">
                                            El campo es obligatorio
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Puntaje</label>
                                        <input name="score" type="text" class="form-control entero" required
                                            autocomplete="false" />
                                        <div class="invalid-feedback">
                                            El campo es obligatorio
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Porcentaje de Descuento</label>
                                        <input name="hintDiscount" type="text" class="form-control decimal" required />
                                        <div class="invalid-feedback">
                                            El campo es obligatorio
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Orden</label>
                                        <input name="order" type="text" class="form-control entero" required />
                                        <div class="invalid-feedback">
                                            El campo es obligatorio
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="idCompetition" name="idCompetition" value="{{ app('request')->has('competition') ? app('request')->input('competition') : 0 }}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- larg level modal -->
<div id="detaillevelModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Detalle de Nivel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <ul class="nav nav-tabs2 justify-content-end">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab"
                            href="#tabUserDetail">Detalle</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabUserEdit">Editar</a></li>
                    <li class="nav-item"><a id="btnLevelDelete" class="nav-link">Eliminar</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show vivify flipInX active" id="tabUserDetail">
                        <div class="row pt-4 px-3">
                            <div class="col-6 form-group">
                                <strong class="text-white">Nombre Nivel:</strong>
                                <span id="levelName" class=""></span>
                            </div>
                            <div class="col-6 form-group">
                                <strong class="text-white">Puntaje:</strong>
                                <span id="levelScore"></span>
                            </div>
                            <div class="col-6 form-group">
                                <strong class="text-white">Porcentaje descuento:</strong>
                                <span id="levelHintDiscount"></span>
                            </div>
                            <div class="col-6 form-group">
                                <strong class="text-white">Orden:</strong>
                                <span id="levelOrder"></span>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane vivify flipInX" id="tabUserEdit">
                        <div class="pt-4 px-3">
                            <form id="updateLevelForm" action="{{ route('levels.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" id="levelID">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Nombre nivel</label>
                                            <input name="name" autofocus type="text" class="form-control" required
                                                autocomplete="false" maxlength="25">
                                            <div class="invalid-feedback">
                                                El campo es obligatorio
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Puntaje</label>
                                            <input name="score" type="text" class="form-control entero" required
                                                autocomplete="false" />
                                            <div class="invalid-feedback">
                                                El campo es obligatorio
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary">Guardar</button>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Porcentaje de Descuento</label>
                                            <input name="hintDiscount" type="text" class="form-control decimal" required />
                                            <div class="invalid-feedback">
                                                El campo es obligatorio
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Orden</label>
                                            <input name="order" type="text" class="form-control entero" required />
                                            <div class="invalid-feedback">
                                                El campo es obligatorio
                                            </div>
                                        </div>
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
<script src="{{asset('vendor/sweetalert/sweetalert.min.js')}}"></script><!-- SweetAlert Plugin Js -->
{{-- <script src="{{asset('js/pages/tables/jquery-datatable.js')}}"></script> --}}
<script src="{{asset('js/pages/ui/dialogs.js')}}"></script>
<script>
    let levelTable = null;
    $(document).ready(function () {

        $('.decimal').toArray().forEach(element => {
            ValidarInput('decimal', element);
        });
        $('.entero').toArray().forEach(element => {
            ValidarInput('integer', element);
        });

        let idCompetition = $('#idCompetition').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        levelTable = $('#levelTable').DataTable({
            language: {
                url: "{{asset('lenguage/Spanish.json')}}"
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('levels.list') }}",
                data: {
                    competition: idCompetition
                }
            },
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'score',
                    name: 'score'
                },
                {
                    data: 'hintDiscount',
                    name: 'hintDiscount'
                },
                {
                    data: 'DT_RowId',
                    name: 'DT_RowId',
                    visible: false
                }
            ]
        });

        // row id
        $('#levelTable').on('click', 'tr', function () {
            var id = levelTable.row(this).id();
            if (id) {
                CargarNivel(id);
            }
        });

        function CargarNivel(id) {
            var attr = $('#btnLevelDelete').attr('id');

            if (typeof attr !== typeof undefined && attr !== false) {
                $('#btnLevelDelete').data('id', id);
            } else {
                $('#btnLevelDelete').attr('data-id', id);
            }

            $.ajax({
                type: "GET",
                url: "{{ route('levels.get') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                dataType: "JSON",
                success: function (data) {
                    $('#levelID').val(data.id);
                    $('#levelName').html(data.name);
                    $('#levelScore').html(`#${data.score}`);
                    $('#levelHintDiscount').html(`${(parseFloat(data.hintDiscount) * 100).toFixed(2)}%`);
                    $('#levelOrder').html(`#${data.order}`);

                    $('#updateLevelForm').find('input[name=id]').val(data.id);
                    $('#updateLevelForm').find('input[name=name]').val(data.name);
                    $('#updateLevelForm').find('input[name=score]').val(`${data.score}`);
                    $('#updateLevelForm').find('input[name=hintDiscount]').val(`${(parseFloat(data.hintDiscount) * 100).toFixed(2)}`);
                    $('#updateLevelForm').find('input[name=order]').val(`${data.order}`);
                },
                error: function (err) {
                    console.log(err);
                    return false;
                },
                complete: function() {
                    $('#detaillevelModal').modal('show');
                }
            });

        }

        // confirm delete level
        $('#btnLevelDelete').click(function (e) {
            e.preventDefault();
            let btn = $(this);
            let id = btn.data('id');
            showConfirmMessage(btn, 'nivel', 'el nivel', id);
        });

        function showConfirmMessage(trigger, tipo, campo, id) {
            swal({
                title: `Esta seguro de eliminar ${campo} ?`,
                text: "Esta accion no se puede deshacer!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Si, eliminar!",
                closeOnConfirm: false,
                cancelButtonText: 'Cancelar'
            }, function () {
                switch (tipo) {
                    case 'nivel':
                        trigger.prop('disabled', true);
                        $.ajax({
                            type: "POST",
                            url: "{{ route('levels.delete') }}",
                            data: {
                                id: id,
                                _token: "{{ csrf_token() }}"
                            },
                            dataType: "JSON",
                            cache: false,
                            success: function (response) {
                                if (response.status) {
                                    swal({
                                        title: "Correcto",
                                        text: "Nivel eliminado correctamente",
                                        type: 'success'
                                    });
                                    levelTable.ajax.reload();
                                    $('#detaillevelModal').modal('hide');

                                } else {
                                    swal({
                                        title: "Error!",
                                        text: response.msgError,
                                        type: "error",
                                    });
                                }
                            },
                            error: function (err) {
                                swal({
                                    title: "Error!",
                                    text: "Error desconocido, intente nuevamente!",
                                    type: "error",
                                });
                                console.log(err);
                            },
                            complete: function () {
                                trigger.prop('disable', false);
                            }
                        });
                        break;
                    default:
                        break;
                }
            });
        }
    });

    //Register level

    var form = document.getElementById('registerLevelForm');
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        event.stopPropagation();
        if (form.checkValidity() === true) {

            let form = this;

            $(form).find('button').prop('disabled', true);
            let method = $(form).attr('method');
            let action = $(form).attr('action');

            $.ajax({
                type: method,
                url: action,
                data: $(form).serialize(),
                dataType: "JSON",
                success: function (response) {
                    if (response.status) {
                        swal({
                            type: 'success',
                            title: 'Correcto',
                            text: 'Nivel registrado correctamente'
                        });

                        $('#registerlevelModal').modal('hide');
                        levelTable.ajax.reload();
                        $(form).removeClass('was-validated');
                    } else {
                        $(form).removeClass('was-validated');
                        if (response.validationErrors !== undefined) {
                            let keys = Object.keys(response.validationErrors);
                            let errors = response.validationErrors;
                            keys.forEach(key => {
                                let node = $(form).find(`input[name=${key}]`);
                                console.log(node);
                                node.addClass('is-invalid');
                                let errores = "";
                                errors[`${key}`].forEach(error => {
                                    errores += error + '\n';
                                });
                                $(node[0]).parent().find('.invalid-feedback').html(errores);
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
                    swal({
                        type: 'error',
                        title: 'Error',
                        text: 'Error Desconocido'
                    });
                    console.log(err);
                },
                complete: function () {
                    $(form).find('button').prop('disabled', false);
                }
            });

        }
        form.classList.add('was-validated');
    }, false);


    $(document).on('hide.bs.modal', '#registerlevelModal', function () {
        let modal = $(this);
        let form = modal.find('form')

        form[0].reset();
        $(form).find('input').removeClass('is-invalid');
        form.find('.invalid-feedback').toArray().forEach(element => {
            $(element).html('El Campo es obligatorio.')
        });
    });

    //Modificar Nivel

    var formUpdLevel = document.getElementById('updateLevelForm');
    formUpdLevel.addEventListener('submit', function (event) {
        event.preventDefault();
        event.stopPropagation();
        if (formUpdLevel.checkValidity() === true) {

            let formUpdLevel = this;

            $(formUpdLevel).find('button').prop('disabled', true);
            let method = $(formUpdLevel).attr('method');
            let action = $(formUpdLevel).attr('action');

            $.ajax({
                type: method,
                url: action,
                data: $(formUpdLevel).serialize(),
                dataType: "JSON",
                success: function (response) {
                    if (response.status) {
                        swal({
                            type: 'success',
                            title: 'Correcto',
                            text: 'Nivel actualizado correctamente'
                        });

                        $('#detaillevelModal').modal('hide');
                        levelTable.ajax.reload();
                    } else {
                        $(formUpdLevel).removeClass('was-validated');
                        if (response.validationErrors !== undefined) {
                            let keys = Object.keys(response.validationErrors);
                            let errors = response.validationErrors;
                            keys.forEach(key => {
                                let node = $(formUpdLevel).find(`input[name=${key}]`);
                                console.log(node);
                                node.addClass('is-invalid');
                                let errores = "";
                                errors[`${key}`].forEach(error => {
                                    errores += error + '\n';
                                });
                                $(node[0]).parent().find('.invalid-feedback').html(errores);
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
                    swal({
                        type: 'error',
                        title: 'Error',
                        text: 'Error Desconocido'
                    });
                    console.log(err);
                },
                complete: function () {
                    $(formUpdLevel).find('button').prop('disabled', false);
                }
            });

        }
        formUpdLevel.classList.add('was-validated');
    }, false);

    $(document).on('hide.bs.modal', '#detaillevelModal', function () {
        let modal = $(this);

        modal.find('#levelID').val('');
        modal.find('#levelName').html('');
        modal.find('#levelScore').html('');
        modal.find('#levelHintDiscount').html('');
        modal.find('#levelOrder').html('');

        modal.find('#updateLevelForm').find('input[name=id]').val('');
        modal.find('#updateLevelForm').find('input[name=name]').val('');
        modal.find('#updateLevelForm').find('input[name=score]').val('');
        modal.find('#updateLevelForm').find('input[name=hintDiscount]').val('');
        modal.find('#updateLevelForm').find('input[name=order]').val('');

        formUpdLevel.reset();
        formUpdLevel.classList.remove('was-validated')
        $(formUpdLevel).find('input').removeClass('is-invalid');
        $(formUpdLevel).find('.invalid-feedback').toArray().forEach(element => {
            $(element).html('El Campo es obligatorio.')
        });
    });


    function setInputFilter(textbox, inputFilter) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function (
            event) {
            textbox.addEventListener(event, function () {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                }
            });
        });
    }

    function ValidarInput(type, input) {
        switch (type) {
            case 'integer':
                setInputFilter(input, function (value) {
                    return /^\d*$/.test(value);
                });
                break;
            case 'decimal':
                setInputFilter(input, function (value) {
                    return /^\d*[.]?\d{0,2}$/.test(value);
                });
                break;
            default:
                break;
        }
    }

</script>
@endsection
