@extends('judgeLayout.master')
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
                        <div id="teamData" class="row">
                            <div class="col-4">
                                <div class=" bg-dark rounded w-100 h-75">
                                    Avatar
                                    <img class="bg-red " width="300" height="500" src="" alt="">
                                </div>
                                <div class=" form-group">
                                    <strong class=" font-18">Puntaje:</strong>
                                    <span name="score"></span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Nombre:</strong>
                                    <span name="name"></span>
                                </div>
                                <div class="form-group">
                                    <strong>Couch:</strong>
                                    <span name="couch"></span>
                                </div>
                                <div class="form-group">
                                    <strong>Frase</strong>
                                    <p name="phrase">

                                    </p>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div id=userData class="py-2">
                        <h6>Credenciales de Equipo</h6>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Usuario Equipo:</strong>
                                    <span name="username"></span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Contraseña Equipo:</strong>
                                    <span name="teamPassword"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="py-2">
                        <h6>Miembros</h6>
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
                            <h6>Datos de Equipo</h6>
                            <div id="teamDataRegister" class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Nombre</label>
                                        <input name="teamData[name]" class="form-control" type="text" maxlength="55" required>
                                        <div class="invalid-feedback">
                                            El campo nombre es obligatorio
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Couch</label>
                                        <input name=teamData[couch] class="form-control" type="text" maxlength="55" required>
                                         <div class="invalid-feedback">
                                            El campo couch es obligatorio
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Frase</label>
                                        <textarea name="teamData[phrase]" class="form-control" id="" cols="30" rows="5" maxlength="65535" required></textarea>
                                         <div class="invalid-feedback">
                                            El campo frase es obligatorio
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-2">
                            <h6>Credenciales de Equipo</h6>
                            <div id="userDataRegister" class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Usuario</label>
                                        <input name="userData[username]" class="form-control" type="text" maxlength="40" required>
                                         <div class="invalid-feedback">
                                            El campo usuario es obligatorio
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="`form-group">
                                        <label for="">Contraseña</label>
                                        <input cl name="userData[password]"class="form-control" type="password" maxlength="35" required>
                                         <div class="invalid-feedback">
                                            El campo contraseña es obligatorio
                                        </div>
                                    </div>
                                </div>

                                <input
                                id="admin"
                                name="userData[admin]"
                                type="hidden"
                                value="false"
                            />
                            </div>
                        </div>
                        <div class="py-2">
                            <h6>Miembros</h6>
                            <div id="memberDataRegister" class="row">
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


   $(document).ready(function(){

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        let id={{$id}};
        getDetails(id);


    });
    function getDetails(idTeam){

   $.ajax({
                            type: "POST",
                            url: "{{ route('teams.get') }}",
                            data: {
                                id: idTeam,
                                _token: "{{ csrf_token() }}"
                            },
                            dataType: "JSON",
                            cache: false,
                            success: function (response) {
                                if (response.status) {

                                    console.log(response);
                                   let divTeam = $('#teamData');
                                   let divUser = $('#userData');
                                   let divTeamRegister = $('#teamDataRegister');
                                   let divUserRegister = $('#userDataRegister');
                                   let data = response.teamData;
                                   let dataUser = response.userData;
                                   let dataMembers =response.membersData;
                                   let node;
                                   node= divTeam.find('span[name="couch"]');
                                   node.text(data.couch);

                                   node= divTeam.find('span[name="score"]');
                                   node.text(data.score);
                                   node= divTeam.find('p[name="phrase"]');
                                   node.text(data.phrase);
                                   node= divTeam.find('span[name="name"]');
                                   node.text(data.name);




                                   node= divUser.find('span[name="username"]');
                                   node.text(dataUser.username);
                                   node= divUser.find('span[name="teamPassword"]');
                                   node.text(data.teamPassword);



                                   //------------------------------------------recuperacion de datos
                                 //  node = $("#formUseUpdate").find(
                                   //     'input[name^="teamData[name]"]'
                                    //);
                                    //node.text(data.name);

                                   //------------------------------------------insercion de datos

                                  dataMembers.forEach(element => {

                                    var desing = `  <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="form-group">
                                                    <strong>Nombre:</strong>
                                                    <span name="name">${element.name}</span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <strong>Apellido:</strong>
                                                    <span name="lastname">${element.lastname}</span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <strong>Universidad:</strong><br>
                                                    <span name="university">${element.university}</span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <strong>Carrera:</strong><br>
                                                    <span name="career">${element.career}</span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class=" form-group">
                                                    <strong>Correo:</strong><br>
                                                    <span name="email">${element.email}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>`;
                                      $('#gruopMembers').append(desing);
                                  });

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
                            }

                        });

    }

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
            let btn = $(this);


            let id={{$id}};

            showConfirmMessage(btn, id );

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
                                    window.location.href='{{ route("teams.list") }}';
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
