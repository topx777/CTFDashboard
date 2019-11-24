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
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#tabDetailTeam">Detalle</a>
                </li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabEditTeam">Editar</a></li>
                <li class="nav-item"><a class="nav-link" id="btnTeamDel" >Eliminar</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show vivify pullUp active" id="tabDetailTeam">
                    <div class="py-2">
                        <h6>Datos de Equipo</h6>
                        <div class="row">
                            <div class="col-4">
                                <div class=" bg-dark rounded w-100 h-75">
                                    Avatar
                                    <img class="bg-red " width="300" height="500" src="" alt="">
                                </div>
                                <div class=" form-group">
                                    <strong class=" font-18">Puntaje:</strong>
                                    <span>10000pt</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Nombre:</strong>
                                    <span>NombreEquipo</span>
                                </div>
                                <div class="form-group">
                                    <strong>Couch:</strong>
                                    <span>NombreCouch</span>
                                </div>
                                <div class="form-group">
                                    <strong>Frase</strong>
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur ullam
                                        doloremque incidunt
                                        excepturi corrupti officiis dolor aliquid enim, eius dignissimos molestiae
                                        numquam aperiam nesciunt
                                        omnis iusto eum minima perferendis iure.
                                    </p>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="py-2">
                        <h6>Credenciales de Equipo</h6>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Usuario Equipo:</strong>
                                    <span>NombreUsuarioEquipo</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Contraseña Equipo:</strong>
                                    <span>Team_Password</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="py-2">
                        <h6>Miembros</h6>
                        <div class="row">
                            <div class="col-8">
                                <ul class="list-group-flush">
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="form-group">
                                                    <strong>Nombre:</strong>
                                                    <span>Nombre_Integrante Nombre_Integrante</span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <strong>Apellido:</strong>
                                                    <span>Apellido_Integrante</span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <strong>Universidad:</strong><br>
                                                    <span>Nombre_Universidad_Sede12345</span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <strong>Carrera:</strong><br>
                                                    <span>Titulo Carreta_Integrante</span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class=" form-group">
                                                    <strong>Correo:</strong><br>
                                                    <span>Correo_Integrante@dominio.sub.com</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="form-group">
                                                    <strong>Nombre:</strong>
                                                    <span>Nombre_Integrante Nombre_Integrante</span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <strong>Apellido:</strong>
                                                    <span>Apellido_Integrante</span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <strong>Universidad:</strong><br>
                                                    <span>Nombre_Universidad_Sede12345</span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <strong>Carrera:</strong><br>
                                                    <span>Titulo Carreta_Integrante</span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class=" form-group">
                                                    <strong>Correo:</strong><br>
                                                    <span>Correo_Integrante@dominio.sub.com</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane vivify pullUp" id="tabEditTeam">
                    <form action="" id="formUseUpdate" novalidate>
                        <div class="py-2">
                            <h6>Datos de Equipo</h6>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Nombre</label>
                                        <input class="form-control" type="text" maxlength="55" required>
                                        <div class="invalid-feedback">
                                            El campo nombre es obligatorio
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Couch</label>
                                        <input class="form-control" type="text" maxlength="55" required>
                                         <div class="invalid-feedback">
                                            El campo couch es obligatorio
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Frase</label>
                                        <textarea name="" class="form-control" id="" cols="30" rows="5" maxlength="65535" required></textarea>
                                         <div class="invalid-feedback">
                                            El campo frase es obligatorio
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-2">
                            <h6>Credenciales de Equipo</h6>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Usuario</label>
                                        <input class="form-control" type="text" maxlength="40" required>
                                         <div class="invalid-feedback">
                                            El campo usuario es obligatorio
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="`form-group">
                                        <label for="">Contraseña</label>
                                        <input class="form-control" type="password" maxlength="35" required>
                                         <div class="invalid-feedback">
                                            El campo contraseña es obligatorio
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-2">
                            <h6>Miembros</h6>
                            <div class="row">
                                <div class="col-8">
                                    <ul class="list-group-flush">
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="form-group">
                                                        <label for="">Nombre:</label>
                                                        <input class="form-control" type="text" maxlength="40" required>
                                                        <div class="invalid-feedback">
                                                                El campo nombre es obligatorio
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <div class="form-group">
                                                        <label for="">Apellido:</label>
                                                        <input type="text" class="form-control" maxlength="55" required>
                                                        <div class="invalid-feedback">
                                                            El campo apellido es obligatorio
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="">Universidad:</label>
                                                        <input type="text" class="form-control" maxlength="40" required>
                                                         <div class="invalid-feedback">
                                                            El campo universidad es obligatorio
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="">Carrera:</label>
                                                        <input type="text" class="form-control" maxlength="50" required>
                                                         <div class="invalid-feedback">
                                                            El campo carrera es obligatorio
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class=" form-group">
                                                        <label for="">Correo:</label>
                                                        <input type="text" class="form-control" maxlength="55" required>
                                                         <div class="invalid-feedback">
                                                            El campo correo es obligatorio
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
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
    var form = document.getElementById('formUseUpdate');
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        event.stopPropagation();
        if (form.checkValidity() === true) {
            alert('valido')

        }
        form.classList.add('was-validated');
    }, false);
    // confirm delete team
    $('#btnTeamDel').click(function (e) {
            e.preventDefault();
            showConfirmMessage();

        });
        function showConfirmMessage() {
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
                swal("Deleted!", "El equipo a sido eliminado", "success");
            });
        }
</script>
@endsection