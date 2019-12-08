@extends('adminLayout.master')
@section('style')
<link rel="stylesheet" href="{{asset('vendor/sweetalert/sweetalert.css')}}"/>
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
                <li class="nav-item"><a class="nav-link" id="btnTeamDel">Eliminar</a></li>

            </ul>
            <div class="tab-content">
                <div class="tab-pane show vivify pullUp active" id="tabDetailJudge">
                    <div class="py-2">
                        <h5>Datos de Juez</h5>
                        <div id="judgeData" class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Nombre:</strong>
                                    <span name="name"></span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Apellidos:</strong>
                                    <span name="lastname"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="userData" class="py-2">
                        <h5>Credenciales de Juez</h5>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Usuario:</strong>
                                    <span name="username"></span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Correo:</strong>
                                    <span name="email"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="py-2">
                        <h5>Competencias CTF</h5>
                        <div class="row">
                            <div class="col-8">
                                <ul id="gruopMembers" class="list-group-flush">


                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane vivify pullUp" id="tabEditTeam">
                    <form action="" id="formUseUpdate" novalidate>
                        @csrf
                        <div class="py-2">
                            <h6>Datos de Juez</h6>
                            <div id="teamDataRegister" class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Nombre</label>
                                        <input name="judge[name]" class="form-control" type="text" maxlength="40"
                                            required>
                                        <div class="invalid-feedback">
                                            El campo nombre es obligatorio
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Apellido</label>
                                        <input name="judge[lastname]" class="form-control" type="text" maxlength="55"
                                            required>
                                        <div class="invalid-feedback">
                                            El campo apellido es obligatorio
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-2">
                            <h6>Credenciales de Juez</h6>
                            <div id="userDataRegister" class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Usuario</label>
                                        <input name="judge[username]" class="form-control" type="text" maxlength="40"
                                            required>
                                        <div class="invalid-feedback">
                                            El campo usuario es obligatorio
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input name="judge[password]" class="form-control" type="text" maxlength="35"
                                            required>
                                        <div class="invalid-feedback">
                                            El campo password es obligatorio
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="`form-group">
                                        <label for="">Correo</label>
                                        <input name="judge[email]" class="form-control" type="password" maxlength="55"
                                            required>
                                        <div class="invalid-feedback">
                                            El campo contraseña es obligatorio
                                        </div>
                                    </div>
                                </div>

                                <input id="admin" name="userData[admin]" type="hidden" value="false" />
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
    })
</script>
@endsection