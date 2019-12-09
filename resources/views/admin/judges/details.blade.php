@extends('adminLayout.master')
@section('style')
<link rel="stylesheet" href="{{asset('vendor/sweetalert/sweetalert.css')}}" />
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
        </div>
        <div class="body">
            <ul class="nav nav-tabs2 justify-content-end">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab"
                        href="#tabDetailJudge">Detalle</a>
                </li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabEditTeam">Editar</a></li>
                <li class="nav-item"><a class="nav-link" id="btnJudgeDelete">Eliminar</a></li>

            </ul>
            <div class="tab-content">
                <div class="tab-pane show vivify pullUp active" id="tabDetailJudge">
                    <div class="py-2">
                        <h5>Datos de Juez</h5>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Nombre:</strong>
                                    <span id="dname"></span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Apellidos:</strong>
                                    <span id="dlastname"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="py-2">
                        <h5>Credenciales de Juez</h5>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Usuario:</strong>
                                    <span id="dusername"></span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Correo:</strong>
                                    <span id="demail"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- <div class="py-2">
                        <h5>Competencias CTF</h5>
                        <div class="row">
                            <div class="col-8">
                                <ul id="gruopMembers" class="list-group-flush">


                                </ul>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="tab-pane vivify pullUp" id="tabEditTeam">
                    <form action="" id="formJudgeUpdate" novalidate>
                        @csrf
                        <div class="py-2">
                            <h6>Datos de Juez</h6>
                            <input id="idJudge" type="hidden" name="judge[idJudge]" value="">
                            <div id="teamDataRegister" class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="name">Nombre</label>
                                        <input id="name" name="judge[name]" class="form-control" type="text"
                                            maxlength="40" required>
                                        <div class="invalid-feedback">
                                            El campo nombre es obligatorio
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="lastname">Apellido</label>
                                        <input id="lastname" name="judge[lastname]" class="form-control" type="text"
                                            maxlength="55" required>
                                        <div class="invalid-feedback">
                                            El campo apellido es obligatorio
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-2">
                            <h6>Credenciales de Juez</h6>
                            <input id="idUser" type="hidden" name="judge[idUser]">
                            <div id="userDataRegister" class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="username">Usuario</label>
                                        <input id="username" name="judge[username]" class="form-control" type="text"
                                            maxlength="40" required>
                                        <div class="invalid-feedback">
                                            El campo usuario es obligatorio
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input id="password" value="null" name="judge[password]" class="form-control"
                                            type="password" maxlength="35" required>
                                        <div class="invalid-feedback">
                                            El campo password es obligatorio
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="`form-group">
                                        <label for="email">Correo</label>
                                        <input id="email" name="judge[email]" class="form-control" type="text"
                                            maxlength="55" required>
                                        <div class="invalid-feedback">
                                            El campo correo es obligatorio
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary" type="submit">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('vendor/sweetalert/sweetalert.min.js')}}"></script><!-- SweetAlert Plugin Js -->
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        setDetails();
    })

    function setDetails() {
        $.get("{{route('judges.get')}}", {
            id: {{ $id }}
        },
    function (data, textStatus, jqXHR) {
        // Detail
        $('#dname').html(data.name);
        $('#dlastname').html(data.lastname);
        $('#dusername').html(data.user.username);
        $('#demail').html(data.user.email);
        // Edit
        $('#idJudge').val(data.id);
        $('#name').val(data.name);
        $('#lastname').val(data.lastname);

        $('#idUser').val(data.user.id);
        $('#username').val(data.user.username);
        $('#email').val(data.user.email);
    },
    "JSON"
        );
      }

    var form = document.getElementById('formJudgeUpdate');
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        event.stopPropagation();
        if (form.checkValidity() === true) {

            $.ajax({
                type: "POST",
                url: "{{route('judges.update')}}",
                data: $('#formJudgeUpdate').serialize(),
                dataType: "JSON",
                success: function (response) {
                    if (response.status) {
                        swal({
                            title: "Correcto",
                            text: "Nivel eliminado correctamente",
                            type: 'success'
                        });
                        setDetails();
                        $("#formJudgeUpdate").removeClass("was-validated");
                    } else {
                        $("#formJudgeUpdate").removeClass("was-validated");

                        if (response.errorsUser !== undefined) {
                            let keys = Object.keys(response.errorsUser);
                            let errors = response.errorsUser;

                            let node, node2;
                            keys.forEach(key => {
                                node = $("#formJudgeUpdate").find(
                                    `input[name^="judge[${key}]"]`
                                );
                                if (node !== undefined) {
                                    node.addClass("is-invalid");
                                }
                                let errores = "";
                                errors[`${key}`].forEach(error => {
                                    errores += error + ". \n  ";
                                });

                                if (node !== undefined) {
                                    if (key == "password") {
                                        $(node2[0])
                                            .parent()
                                            .find(".invalid-feedback")
                                            .html(errores);
                                    }
                                    $(node[0])
                                        .parent()
                                        .find(".invalid-feedback")
                                        .html(errores);
                                }
                            });
                        } else {
                            swal({
                                type: "error",
                                title: "Error",
                                text: response.msgError
                            });
                        }


                    }
                }
            });
        }
        form.classList.add('was-validated');
    }, false);

    // confirm delete Judge
    $('#btnJudgeDelete').click(function (e) {
        e.preventDefault();
        let btn = $(this);
        let id = {{ $id }};
        showConfirmMessage(btn, id);
        });

    function showConfirmMessage(trigger, id) {
        swal({
            title: "Esta seguro de eliminar al Juez?",
            text: "Esta accion no se puede deshacer!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "Si, eliminar!",
            closeOnConfirm: false,
            cancelButtonText: 'Cancelar'
        }, function () {
            trigger.prop('disabled', true);
            $.ajax({
                type: "POST",
                url: "{{ route('judges.delete') }}",
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
                            text: "Juez eliminado correctamente",
                            type: 'success'
                        });
                        window.location.href = '{{ route("judges.list") }}';
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
            //swal("Deleted!", "El equipo a sido eliminado", "success");
        });
    }
</script>
@endsection