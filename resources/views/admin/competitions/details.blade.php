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
                <li class="nav-item"><a class="nav-link" id="btnTeamDel">Eliminar</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show vivify pullUp active" id="tabDetailJudge">
                    <div class="py-2">
                        <h5>Datos de Competencia</h5>
                        <div id="judgeData" class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Nombre:</strong>
                                    <span name="name">Mi nombre</span>
                                </div>
                                <div class="form-group">
                                    <strong>Juez:</strong>
                                    <span>Nombre de Juez</span>
                                </div>
                                <div class="form-group">
                                    <strong>Modo de CTF:</strong>
                                    <span></span>
                                </div>
                                <div class="form-group">
                                    <strong>Desbloqueo:</strong>
                                    <span></span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Nivel de Dificultad:</strong>
                                    <span>Dificil</span>
                                </div>
                                <div class="form-group">
                                    <strong>Hora Inicio:</strong>
                                    <span>00/00/000 00:00</span>
                                </div>
                                <div class="form-group">
                                    <strong>Hora Fin:</strong>
                                    <span>00/00/0000 00:00</span>
                                </div>
                                <div class="form-group">
                                    <strong>Deshabilitado:</strong>
                                    <span></span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Reglas:</strong>
                                    <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque sint doloribus cum exercitationem placeat quidem hic aperiam nam eos possimus saepe iure ipsam, sed minima aliquam. Odio deleniti esse veritatis!</span>
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
    })
</script>
@endsection