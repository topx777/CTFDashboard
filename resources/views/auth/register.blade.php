<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ config('app.name', 'CTFDashboard') }} - Registrar</title>
    <meta charset="utf-8">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/animate-css/vivify.min.css')}}">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{asset('css/site.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/sweetalert/sweetalert.css')}}" />
</head>

<body class="theme-cyan font-montserrat">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
            <div class="bar4"></div>
            <div class="bar5"></div>
        </div>
    </div>

    <div id="myBar"></div>

    <div class="pattern">
        <span class="red"></span>
        <span class="indigo"></span>
        <span class="blue"></span>
        <span class="green"></span>
        <span class="orange"></span>
    </div>

    <div class="auth-main particles_js" style="align-items: flex-start">
        <div class="auth_div vivify popIn" style="width: 90%">
            <div class="card">
                <div class="body">
                    <div class="col-md-12">
                        <h4>Registrar mi Equipo a la Competencia</h4>
                    </div>
                    <div class="col-12">
                        <form id="userRegister" method="POST" action="{{ route('register') }}"
                            enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="card">
                                <div class="header">
                                    <h2>Datos de equipo</h2>
                                </div>
                                <div class="body">
                                    <div class="row">
                                        <input type="hidden" name="teamData[idCompetition]"
                                            value="{{ app('request')->has('ref') ? app('request')->input('ref') : 0 }}">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Nombre</label>
                                                <input name="teamData[name]" autofocus type="text" class="form-control"
                                                    required maxlength="55" />
                                                <div class="invalid-feedback">
                                                    El campo nombre es obligatorio
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Couch</label>
                                                <input name="teamData[couch]" type="text" class="form-control" required
                                                    maxlength="55" />
                                                <div class="invalid-feedback">
                                                    El campo couch es obligatorio
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Frase</label>
                                                <textarea name="teamData[phrase]" class="form-control" cols="30"
                                                    rows="3" required maxlength="65535"></textarea>
                                                <div class="invalid-feedback">
                                                    El campo Frase es obligatorio
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Username</label>
                                                <input name="userData[username]" autofocus type="text"
                                                    class="form-control" required maxlength="40" />
                                                <div class="invalid-feedback">
                                                    El campo username es obligatorio
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="">Password</label>
                                                <input id="password" name="userData[password]" type="password"
                                                    class="form-control" required maxlength="35" />
                                                <div class="invalid-feedback">
                                                    El campo password es obligatorio
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="">Confimar Password</label>
                                                <input id="password_confirmation" name="userData[password_confirmation]"
                                                    type="password" class="form-control" required maxlength="35" />
                                                <div class="invalid-feedback">
                                                    El campo password es obligatorio
                                                </div>
                                            </div>
                                            <input id="role" name="userData[role]" type="hidden" value="2" />
                                            <input type="hidden" name="external" value="1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="header">
                                    <h2>Miembros de Equipo</h2>
                                </div>
                                <div class="body">
                                    <ul id="ulMemberList" class="list-group"></ul>
                                    <div>
                                        <button id="btnAddMember" class="btn btn-block btn-primary" type="button">
                                            Añadir nuevo miembro
                                        </button>
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

                </div>
            </div>
        </div>
        <div id="particles-js"></div>
    </div>
    <!-- END WRAPPER -->

    <script src="{{asset('bundles/libscripts.bundle.js')}}"></script>
    <script src="{{asset('bundles/vendorscripts.bundle.js')}}"></script>
    <script src="{{asset('bundles/mainscripts.bundle.js')}}"></script>
    <script src="{{asset('vendor/sweetalert/sweetalert.min.js')}}"></script><!-- SweetAlert Plugin Js -->
    <script>
        var members = 0;

        $(document).ready(function () {
            addMember();
            // createNewPassword();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });


        $(document).on("keyup", "input", function () {
            $(this).removeClass("is-invalid");
        });

        var form = document.getElementById("userRegister");
        form.addEventListener(
            "submit",
            function (event) {
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
                                window.location.href = response.intended;
                            } else {
                                //codigo de validacion
                                swal({
                                    type: "error",
                                    title: "Error",
                                    text: response.msgError
                                });

                                $("#userRegister").removeClass("was-validated");
                                if (response.errorsUser !== undefined) {
                                    let keys = Object.keys(response.errorsUser);
                                    let errors = response.errorsUser;

                                    let node, node2;
                                    keys.forEach(key => {
                                        node = $("#userRegister").find(
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
                                        nodeTeam = $("#userRegister").find(
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
                                            nodeMember = $("#userRegister").find(
                                                `input[name^="membersData[${nodesErrors[cont]}][${key}]"]`
                                            );



                                            if (nodeMember !== undefined) {
                                                nodeMember.addClass("is-invalid");
                                            }


                                            let erroresMember = "";
                                            errorsMember[`${key}`].forEach(error => {
                                                erroresMember += error +
                                                    ". \n  ";
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
                form.classList.add("was-validated");
            },
            false
        );
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

        //members team delete
        function membersDelete(id) {
            $(`#${id}`).remove();
        }

    </script>
</body>

</html>
