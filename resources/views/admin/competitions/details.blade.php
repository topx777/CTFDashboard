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
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#tabDetailJudge">Detalle</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show vivify pullUp active" id="tabDetailJudge">
                    <div class="py-2">
                        <div class="py-3">
                            <div class="float-right">
                                    Deshabilitado
                                    <label class="switch">
                                        <input id="checkDisable" class="" type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                        </div>
                        <hr>
                        <h5>Datos de Competencia</h5>
                        <div id="judgeData" class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Nombre:</strong>
                                    <span id="name"></span>
                                </div>
                                
                                <div class="form-group">
                                    <strong>Desbloqueo:</strong>
                                    <span id="unlockType"></span>
                                </div>
                            </div>
                            <div class="col-4">
                                 <div class="form-group">
                                    <strong>Deshabilitado:</strong>
                                    <span id="masterDisabled"></span>
                                </div>
                                <div class="form-group">
                                    <strong>Estado:</strong>
                                    <span id="state"></span>
                                </div>
                                <div class="form-group">
                                    <strong>Modo de CTF:</strong>
                                    <span id="gameMode"></span>
                                </div>

                                <div class="form-group">
                                    <strong>Nivel de Dificultad:</strong>
                                    <span id="dificulty"></span>
                                </div>
                                <div class="form-group">
                                    <strong>Hora Inicio:</strong>
                                    <span id="startTime"></span>
                                </div>
                                <div class="form-group">
                                    <strong>Hora Fin:</strong>
                                    <span id="endTime"></span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Reglas:</strong>
                                    <span id="rules"></span>
                                </div>
                            </div>
                        </div>
                        <h5>Datos de Juez</h5>
                        <div class="row">
                            <div class="col-4">
                                 <div class="form-group">
                                    <strong>Nombre:</strong>
                                    <span id="jname"></span>
                                </div>
                            </div>
                            <div class="col-4">
                                 <div class="form-group">
                                    <strong>Apellidos:</strong>
                                    <span id="jlastname"></span>
                                </div>
                            </div>
                        </div>
                    </div>
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
        setDetail();
    })

    function setDetail() {
        $.get("{{route('competitions.get')}}", {
            id:{{$id}}
        },
            function (data, textStatus, jqXHR) {
                console.log(data);
                $('#name').html(data.name);
                $('#unlockType').html(setUnlock(data.unlockType));

                $('#masterDisabled').html(setDisable(data.masterDisabled));
                $('#checkDisable')[0].checked=(data.masterDisabled==1)?true:false;
                $('#state').html(setState(data.state));
                $('#gameMode').html(setGameMode(data.gameMode));
                $('#dificulty').html(setDificulty(data.dificulty));
                $('#startTime').html(data.startTime);
                $('#endTime').html(data.endTime);

                $('#rules').html(data.rules);

                // jues
                $('#jname').html(data.judge.name);
                $('#jlastname').html(data.judge.lastname);
            },
            "JSON"
        );
    }

    function setState(state) {
        var badge='';
        switch (state) {
            case 0:
                badge='<span class="badge badge-danger">No Iniciado</span>';
                break;
            case 1:
                badge='<span class="badge badge-success">En Juego</span>';
                break;
        }
        return badge;
    }
    function setDisable(disable) {
        var badge='';
        switch (disable) {
            case 0:
                badge='<span class="text-success"><i class="icon-check  font-weight-bold"></i>&nbsp;Habilitado</span>';
                break;
            case 1:
                badge='<span class="text-danger"><i class="icon-ban  font-weight-bold"></i>&nbsp;Desahabilitado</span>';
                break;
        }
        return badge;
    }
    function setGameMode(mode) {
        var badge='';
        switch (mode) {
            case 0:
                badge='&nbsp;<i class="icon-user font-weight-bold"></i>&nbsp;Presencial';
                break;
            case 1:
                badge='&nbsp;<i class="icon-globe font-weight-bold"></i>&nbsp;Remoto';
                break;
        }
        return badge;
    }
    function setDificulty(dificulty) {
        var badge;
            if(dificulty==0)
                badge ='<span class="badge badge-info">facil</span>';
            if(dificulty== 1)
                badge ='<span class="badge badge-success">medio</span>';
            if(dificulty== 2)
                badge ='<span class="badge badge-warning">dificil</span>';
            if(dificulty== 3)
                badge ='<span class="badge badge-danger">extremo</span>';
        return badge;
    }

    function setUnlock(unlock) {
        var badge='';
        switch (unlock) {
            case 0:
                badge='&nbsp;General';
                break;
            case 1:
                badge='&nbsp;Nivel por Nivel';
                break;
        }
        return badge;
    }
    
    $('#checkDisable').change(function (e) { 
        e.preventDefault();
        var check=$('#checkDisable').prop('checked');
        swal({
            title: "Esta seguro cambiar estado de  Competicion?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "Si, estoy seguro!",
            closeOnConfirm: false,
            cancelButtonText: 'Cancelar'
        }, function () {
            // trigger.prop('disabled', true);
            $.ajax({
                type: "POST",
                url: "{{ route('competitions.disable') }}",
                data: {
                    id: {{$id}},
                    _token: "{{ csrf_token() }}",
                    disable: (check)?1:0
                },
                dataType: "JSON",
                cache: false,
                success: function (response) {
                    if (response.status) {
                        swal({
                            title: "Correcto",
                            text: "Cambio de estado correctamente",
                            type: 'success'
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
                },
                complete: function () {
                    // trigger.prop('disable', false);
                    setDetail();
                }
            });
            //swal("Deleted!", "El equipo a sido eliminado", "success");
        });
    });

</script>
@endsection