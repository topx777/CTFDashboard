@extends('adminLayout.master')

@section('content')
<div class="col-12">
    <form id="userRegister" method="POST" action="{{ route('register') }}" novalidate>
        <div class="card">
            <div class="header">
                <h2>Datos de equipo</h2>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input name="nombre" autofocus type="text" class="form-control" required maxlength="55">
                            <div class="invalid-feedback">
                                El campo nombre es obligatorio
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Couch</label>
                            <input name="couch" type="text" class="form-control" required maxlength="55">
                            <div class="invalid-feedback">
                                El campo couch es obligatorio
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Frase</label>
                            <textarea name="frase" class="form-control" cols="30" rows="5" required
                                maxlength="65535"></textarea>
                            <div class="invalid-feedback">
                                El campo Frase es obligatorio
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="header">
                <h2>Credenciales de Equipo</h2>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input name="nombre" autofocus type="text" class="form-control" required maxlength="40">
                            <div class="invalid-feedback">
                                El campo username es obligatorio
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Password</label>
                            <div class="input-group">
                                    <input name="nombre" autofocus type="text" class="form-control" disabled required maxlength="35">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary">
                                        <i class="fa fa-lock"></i>
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
        </div>
        <div class="card">
            <div class="header">
                <h2>Miembros de Equipo</h2>
            </div>
            <div class="body">
                <ul id="ulMemberList" class="list-group">
                    <li id="m1" class="list-group-item my-1 p-0">
                        <div class="d-flex flex-row">
                            <div class="flex-fill p-2">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="">Nombres</label>
                                            <input name="name" type="text" class="form-control" required maxlength="40">
                                            <div class="invalid-feedback">
                                                El campo nombres es obligatorio
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Apellidos</label>
                                            <input name="lastname" type="text" class="form-control" required
                                                maxlength="55">
                                            <div class="invalid-feedback">
                                                El campo apellidos es obligatorio
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Correo</label>
                                            <input name="email" type="text" class="form-control" required
                                                maxlength="55">
                                            <div class="invalid-feedback">
                                                El campo apellidos es obligatorio
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Carrera</label>
                                            <input name="email" type="text" class="form-control" required
                                                maxlength="50">
                                            <div class="invalid-feedback">
                                                El campo carrera es obligatorio
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Universidad</label>
                                            <input name="email" type="text" class="form-control" required maxlength="40">
                                            <div class="invalid-feedback">
                                                El campo universidad es obligatorio
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-danger" type="button" onclick="membersDelete('m1')">x</button>
                        </div>
                    </li>
                </ul>
                <div>
                    <button id="btnAddMember" class="btn btn-block btn-primary" type="button">Añadir nuevo
                        miembro</button>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="body text-right">
                <button type="submit" class="btn btn-primary">Registrar</button>
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
<script>
    var form = document.getElementById('userRegister');
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        event.stopPropagation();
        if (form.checkValidity() === true) {
            alert('valido')

        }
        form.classList.add('was-validated');
    }, false);
    // members team add
    var members = 1;
    $('#btnAddMember').click(function (e) {
        members += 1;
        $('#ulMemberList').append(`  <li id="m${members}" class="list-group-item my-1 p-0">
                        <div class="d-flex flex-row">
                            <div class="flex-fill p-2">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="">Nombres</label>
                                            <input name="name" type="text" class="form-control" required maxlength="40">
                                            <div class="invalid-feedback">
                                                El campo nombres es obligatorio
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Apellidos</label>
                                            <input name="lastname" type="text" class="form-control" required
                                                maxlength="55">
                                            <div class="invalid-feedback">
                                                El campo apellidos es obligatorio
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Correo</label>
                                            <input name="email" type="text" class="form-control" required
                                                maxlength="55">
                                            <div class="invalid-feedback">
                                                El campo apellidos es obligatorio
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Carrera</label>
                                            <input name="email" type="text" class="form-control" required
                                                maxlength="50">
                                            <div class="invalid-feedback">
                                                El campo carrera es obligatorio
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Universidad</label>
                                            <input name="email" type="text" class="form-control" required maxlength="40">
                                            <div class="invalid-feedback">
                                                El campo universidad es obligatorio
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-danger" type="button" onclick="membersDelete('m${members}')">x</button>
                        </div>
                    </li>`);
    });

    //members team delete
    function membersDelete(id) {
        $(`#${id}`).remove();
    }
</script>
@endsection