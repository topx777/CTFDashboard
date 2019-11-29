@extends('teamLayout.master')
@section('style')
<style>
    #avatar{
        background-image: url('{{asset("images/{$teamData->avatar}")}}') !important;
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
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
@endsection
