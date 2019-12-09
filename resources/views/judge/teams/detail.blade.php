@extends('judgeLayout.master')
@section('style')
<link rel="stylesheet" href="{{asset('vendor/sweetalert/sweetalert.css')}}" />
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
            Detalles de Equipo
        </div>
        <div class="body">
            @if(isset($team) && !is_null($team))
            <ul class="nav nav-tabs2 justify-content-end">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#tabDetailTeam">Detalle</a>
                </li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabEditTeam">Editar</a></li>
                <li class="nav-item"><a class="nav-link" id="btnTeamDel" data-id="{{ $id }}">Eliminar</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show vivify pullUp active" id="tabDetailTeam">
                    <div class="py-2">
                        <h4>Datos de Equipo</h4>
                        <input id="cantMembers" type="hidden" value="{{ $team->Members->count()}}">
                        <div id="teamData" class="row">
                            <div class="col-4">
                                <img class="bg-red rounded" width="250" height="250" src="{{$team->avatar}}">
                                <div class="form-group mt-5">
                                    <strong class="font-18">Puntaje:</strong>
                                    <span class="font-18" name="score">{{$team->score}}</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Nombre:</strong>
                                    <span>{{$team->name}}</span>
                                </div>
                                <div class="form-group">
                                    <strong>Couch:</strong>
                                    <span>{{$team->couch}}</span>
                                </div>
                                <div class="form-group">
                                    <strong>Frase</strong>
                                    <p class="lead">
                                        {{$team->phrase}}
                                    </p>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div id=userData class="py-2">
                        <h4>Credenciales de Equipo</h4>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Usuario Equipo:</strong>
                                    <span>
                                        {{$team->User->username}}
                                    </span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Contraseña Equipo:</strong>
                                    <span>
                                        {{$team->teamPassword}}
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="py-2">
                        <h6>Miembros</h6>
                        <div class="row">
                            <div class="col-8">
                                <ul id="gruopMembers" class="list-group-flush">
                                    @foreach ($team->Members as $member)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="form-group">
                                                    <strong>Nombre:</strong>
                                                    <span>{{ $member->name }}</span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <strong>Apellido:</strong>
                                                    <span>{{ $member->lastname }}</span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <strong>Universidad:</strong><br>
                                                    <span>{{ $member->university }}</span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <strong>Carrera:</strong><br>
                                                    <span>{{ $member->career }}</span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class=" form-group">
                                                    <strong>Correo:</strong><br>
                                                    <span>{{ $member->email }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane vivify pullUp" id="tabEditTeam">
                    <form action="{{ route('teams.update') }}" id="formUseUpdate" novalidate>
                        @csrf
                        <div class="py-2">
                            <h6>Datos de Equipo</h6>
                            <div id="teamDataRegister" class="row">
                                <input type="hidden" id="id" name="teamData[id]" value="{{ $id }}">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Nombre</label>
                                        <input name="teamData[name]" value="{{$team->name}}" autofocus type="text"
                                            class="form-control" required maxlength="55" />
                                        <div class="invalid-feedback">
                                            El campo nombre es obligatorio
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Couch</label>
                                        <input name="teamData[couch]" value="{{$team->couch}}" type="text"
                                            class="form-control" required maxlength="55" />
                                        <div class="invalid-feedback">
                                            El campo couch es obligatorio
                                        </div>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Frase</label>
                                        <textarea name="teamData[phrase]" class="form-control" cols="30" rows="5"
                                            required maxlength="65535">{{$team->phrase}}</textarea>
                                        <div class="invalid-feedback">
                                            El campo Frase es obligatorio
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-2">
                            <h6>Credenciales de Equipo</h6>
                            <div id="userDataRegister" class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input name="userData[username]" value="{{ $team->User->username }}" autofocus
                                            type="text" class="form-control" required maxlength="40" />
                                        <div class="invalid-feedback">
                                            El campo username es obligatorio
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group ">
                                        <label for="">Password</label>
                                        <div class="input-group">
                                            <input id="password" value="{{ $team->teamPassword }}"
                                                name="userData[password]" type="text" readonly class="form-control"
                                                required maxlength="35" />
                                            <div class="input-group-append">
                                                <button id="createPassword" type="button" class="btn btn-primary">
                                                    <i class="fa fa-lock"></i>
                                                    Generar Pass
                                                </button>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">
                                            El campo password es obligatorio
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-2">
                            <h6>Miembros</h6>
                            <div id="memberDataRegister" class="row">
                                <div class="col-12">
                                    <ul id="ulMemberList" class="list-group-flush">
                                        @foreach ($team->Members as $key => $member)
                                        <li id="m{{$key}}" class="list-group-item my-1 p-0">
                                            <div class="d-flex flex-row">
                                                <div class="flex-fill p-2">
                                                    <div class="row">
                                                        <div class="col-8">
                                                            <div class="form-group">
                                                                <label for="">Nombres</label>
                                                                <input name="membersData[{{$key}}][name]" type="text"
                                                                    class="form-control" required maxlength="40"
                                                                    value="{{$member->name}}">
                                                                <div class="invalid-feedback">
                                                                    El campo nombres es obligatorio
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Apellidos</label>
                                                                <input name="membersData[{{$key}}][lastname]"
                                                                    type="text" class="form-control" required
                                                                    maxlength="55" value="{{$member->lastname}}">
                                                                <div class="invalid-feedback">
                                                                    El campo apellidos es obligatorio
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="">Correo</label>
                                                                <input name="membersData[{{$key}}][email]" type="text"
                                                                    class="form-control" required maxlength="55"
                                                                    value="{{$member->email}}">
                                                                <div class="invalid-feedback">
                                                                    El campo apellidos es obligatorio
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Carrera</label>
                                                                <input name="membersData[{{$key}}][career]" type="text"
                                                                    class="form-control" required maxlength="50"
                                                                    value="{{$member->career}}">
                                                                <div class="invalid-feedback">
                                                                    El campo carrera es obligatorio
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="">Universidad</label>
                                                                <input name="membersData[{{$key}}][university]"
                                                                    type="text" class="form-control" required
                                                                    maxlength="40" value="{{$member->university}}">
                                                                <div class="invalid-feedback">
                                                                    El campo universidad es obligatorio
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-danger" type="button"
                                                    onclick="membersDelete('m{{$key}}')">x</button>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <div>
                                        <button id="btnAddMember" class="btn btn-block btn-primary" type="button">
                                            Añadir nuevo miembro
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <button class="btn btn-success" type="submit">Guardar Equipo</button>
                        </div>
                    </form>
                </div>
            </div>
            @else
            <h3>No se encontro Equipo</h3>
            @endif
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('vendor/sweetalert/sweetalert.min.js')}}"></script><!-- SweetAlert Plugin Js -->
<script>
    let members = null;

    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        members = $('#cantMembers').val();
    });

    var form = document.getElementById('formUseUpdate');
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        event.stopPropagation();
        if (form.checkValidity() === true) {
            let formURL = $(form).attr("action");
            let formData = $(form).serialize();
            $.ajax({
                type: "POST",
                url: formURL,
                data: formData,
                cache: false,
                dataType: "JSON",
                success: function (response) {
                    if (response.status) {
                        window.location.href = '{{ route("teams.list", ["competition" => isset($team) && !is_null($team) ? encrypt($team->idCompetition) : 0]) }}';
                    } else {
                        //codigo de validacion
                        swal({
                            type: "error",
                            title: "Error",
                            text: response.msgError
                        });

                        $("#formUseUpdate").removeClass("was-validated");
                        if (response.errorsUser !== undefined) {
                            let keys = Object.keys(response.errorsUser);
                            let errors = response.errorsUser;

                            let node, node2;
                            keys.forEach(key => {
                                node = $("#formUseUpdate").find(
                                    `input[name^="userData[${key}]"]`
                                );


                                if (node !== undefined) {
                                    node.addClass("is-invalid");
                                }


                                let errores = "";
                                errors[`${key}`].forEach(error => {
                                    errores += error + ". \n  ";
                                });

                                if (node !== undefined) {

                                    $(node[0])
                                        .parent()
                                        .find(".invalid-feedback")
                                        .html(errores);
                                }
                            });
                        }

                        if (response.errorsTeam !== undefined) {
                            //-------------------------------------
                            let keysTeam = Object.keys(response.errorsTeam);
                            let errorsTeam = response.errorsTeam;

                            let nodeTeam;
                            keysTeam.forEach(key => {
                                nodeTeam = $("#formUseUpdate").find(
                                    `input[name^="teamData[${key}]"]`
                                );


                                if (nodeTeam !== undefined) {
                                    nodeTeam.addClass("is-invalid");
                                }


                                let erroresTeam = "";
                                errorsTeam[`${key}`].forEach(error => {
                                    erroresTeam += error + ". \n  ";
                                });

                                if (nodeTeam !== undefined) {

                                    $(nodeTeam[0])
                                        .parent()
                                        .find(".invalid-feedback")
                                        .html(erroresTeam);
                                }
                            });
                            //-------------------------------------
                            //  alert(response.msgError);
                        }

                        if (response.errorsMembers !== undefined) {
                            //-------------------------------------
                            let keysMembers;
                            let errorsMember;
                            let nodeMember;
                            let arrayMembers = response.errorsMembers;
                            let nodesErrors = response.nodosError;
                            var cont = 0;
                            arrayMembers.forEach(nodeMemberC => {

                                keysMembers = Object.keys(nodeMemberC);
                                errorsMember = nodeMemberC;

                                keysMembers.forEach(key => {
                                    nodeMember = $("#formUseUpdate").find(
                                        `input[name^="membersData[${nodesErrors[cont]}][${key}]"]`
                                    );



                                    if (nodeMember !== undefined) {
                                        nodeMember.addClass("is-invalid");
                                    }


                                    let erroresMember = "";
                                    errorsMember[`${key}`].forEach(error => {
                                        erroresMember += error + ". \n  ";
                                    });

                                    if (nodeMember !== undefined) {

                                        $(nodeMember[0])
                                            .parent()
                                            .find(".invalid-feedback")
                                            .html(erroresMember);
                                    }

                                });
                                cont++;
                            });
                        }
                        // fin de codigo de validacion
                    }
                },
                error: function (err) {
                    console.log(err);
                    swal({
                        type: "error",
                        title: "Error Critico!!",
                        text: "Error inesperado, intentelo nuevamente"
                    });
                }
            });
        }
        form.classList.add('was-validated');
    }, false);


    // confirm delete team
    $('#btnTeamDel').click(function (e) {
        e.preventDefault();
        let btn = $(this);
        let id = btn.data('id');
        showConfirmMessage(btn, id);
    });

    function showConfirmMessage(trigger, id) {
        swal({
            title: "Esta seguro de eliminar al equipo?",
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
                url: "{{ route('teams.delete') }}",
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
                        window.location.href =
                            '{{ route("teams.list", ["competition" => isset($team) && !is_null($team) ? encrypt($team->idCompetition) : 0]) }}';
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
        });
    }

    // members team add
    $("#btnAddMember").click(function (e) {
        addMember();
    });

    function addMember() {
        let memberTemplate = `
        <li id="m${members}" class="list-group-item my-1 p-0">
            <div class="d-flex flex-row">
                <div class="flex-fill p-2">
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label for="">Nombres</label>
                                <input name="membersData[${members}][name]" type="text" class="form-control" required maxlength="40">
                                <div class="invalid-feedback">
                                    El campo nombres es obligatorio
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Apellidos</label>
                                <input name="membersData[${members}][lastname]" type="text" class="form-control" required
                                    maxlength="55">
                                <div class="invalid-feedback">
                                    El campo apellidos es obligatorio
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Correo</label>
                                <input name="membersData[${members}][email]" type="text" class="form-control" required
                                    maxlength="55">
                                <div class="invalid-feedback">
                                    El campo apellidos es obligatorio
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Carrera</label>
                                <input name="membersData[${members}][career]" type="text" class="form-control" required
                                    maxlength="50">
                                <div class="invalid-feedback">
                                    El campo carrera es obligatorio
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Universidad</label>
                                <input name="membersData[${members}][university]" type="text" class="form-control" required maxlength="40">
                                <div class="invalid-feedback">
                                    El campo universidad es obligatorio
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-danger" type="button" onclick="membersDelete('m${members}')">x</button>
            </div>
        </li>`;
        members += 1;
        $("#ulMemberList").append(memberTemplate);
    }

    function membersDelete(id) {
        $(`#${id}`).remove();
    }

    $("#createPassword").click(function () {
        createNewPassword();
    });

    function createNewPassword() {
        var abecedario = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s",
            "t", "u", "v", "w", "x", "y", "z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D",
            "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y",
            "Z"
        ];
        var letras = "";
        for (var i = 0; i < 10; i++) {
            letras +=
                abecedario[
                    parseInt(Math.random() * (abecedario.length - 0) + 0)
                ];
        }

        $("#password").val(letras);
    }

</script>
@endsection
