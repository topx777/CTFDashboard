@extends('teamLayout.master')
@section('style')
<link rel="stylesheet" href="{{asset('vendor/dropify/css/dropify.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/sweetalert/sweetalert.css')}}" />
<style>
    #avatar {
        background-image: url('{{($teamData->avatar=="default.jpeg")? asset("images/default.jpeg"):asset("storage/{$teamData->avatar}") }}') !important;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }
</style>
@endsection
@section('content')
<div class="col-12 py-3">
    <h4 class=" text-info">
        Bienvenido
    </h4>
    <hr class=" bg-info">
</div>
<div class="col-6">
    <div class="card">
        <div class="card-body d-flex justify-content-center flex-column align-content-center align-items-center">
            <div>
                <h5>{{$teamData->name}}</h5>
            </div>
            <div id="avatar" style="width:300px; height: 320px" class="bgimage rounded bg-white">

            </div>
            <div>
                <hr>
                <div>
                    <strong>Couch:</strong>
                    <span>{{$teamData->couch}}</span>
                </div>
                <p class=" py-2">
                    {{$teamData->phrase}}
                </p>
            </div>
            <div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Editar datos</button>
            </div>
        </div>

    </div>
    <div class="card">
        <div class="card-body">
            <h6 class="text-info">Integrantes de Equipo</h6>
        </div>
        <ul class="list-group">
            @if($membersTeam->isEmpty())
            <li class=" list-group-item">
                <span>No Existen Integrantes</span>
            </li>
            @else
            @foreach ($membersTeam as $member)
            <li class="list-group-item">
                <div>
                    <strong>Nombre:</strong>
                    <span>{{$member->name.''.$member->lastname}}</span>
                </div>
                <div class="d-flex flex-row">
                    <div>
                        <strong>Universidad:</strong>
                        <span>{{$member->university}}</span>
                    </div>
                    &nbsp;
                    <div>
                        <strong>Carrera:</strong>
                        <span>{{$member->career}}</span>
                    </div>
                </div>
                <div>
                    <strong>Correo:</strong>
                    <span>{{$member->email}}</span>
                </div>
            </li>
            @endforeach
            @endif
        </ul>
    </div>
</div>
<div class="col-6">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    @php
                    $dStart=date_create($options->startTime);
                    @endphp
                    <span>Inicio:</span>
                    <h4>{{date_format($dStart, 'H:i A')}}</h4>
                    <small>{{date_format($dStart, 'd/m/Y')}}</small>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    @php
                    $dEnd=date_create($options->endTime);
                    @endphp
                    <span>Fin:</span>
                    <h4>{{date_format($dEnd, 'H:i A')}}</h4>
                    <small>{{date_format($dEnd, 'd/m/Y')}}</small>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <span>Puntos:</span>
                    <h4>{{$teamData->score}}</h4>
                    <small><b>Totales</b></small>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class=" card-body">
            <h5 class="text-info">Reglas CTF</h5>
            <hr>
            <p>
                {!!$options->rules!!}
            </p>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Editar Datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="formTeamUpdate" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                <input type="hidden" name="id" value="{{$teamData->id}}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="team[password]" id="" value="novalue">
                                <div class="invalid-feedback">
                                    Campo password requerido
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Frase de Equipo:</label>
                                <textarea name="team[phrase]" class="form-control" id="" cols="30" rows="5">{{$teamData->phrase}}</textarea>
                                <div class="invalid-feedback">
                                    Campo frase requerido
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">Avatar</label>
                                <input type="file" name="avatar" class="dropify">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-round btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('vendor/dropify/js/dropify.js')}}"></script>
<script>
    $(function () {
        $('.dropify').dropify();
    });

    var form = document.getElementById('formTeamUpdate');
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        event.stopPropagation();
        if (form.checkValidity() === true) {
            let formData = new FormData(form);
            $.ajax({
                type: "POST",
                url: "{{route('team.updatemydata')}}",
                data: formData,
                cache: false,
                dataType: "JSON",
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status) {
                        swal({
                            title: "Correcto",
                            text: "Datos guardados correctamente",
                            type: 'success'
                        });
                        $('#updateModal').modal('hide');
                    } else {
                        //codigo de validacion
                        swal({
                            type: "error",
                            title: "Error",
                            text: response.msgError
                        });

                        $("#formTeamUpdate").removeClass("was-validated");
                        if (response.errors !== undefined) {
                            let keys = Object.keys(response.errors);
                            let errors = response.errors;

                            let node, node2;
                            keys.forEach(key => {
                                node = $("#formTeamUpdate").find(
                                    `input[name^="team[${key}]"]`
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

</script>
@endsection
