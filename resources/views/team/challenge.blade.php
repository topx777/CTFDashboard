@extends('teamLayout.master')
@section('content')

<div class="col-lg-6">
    <div class="card">
        <div class="body">
            <div id="slider2" class="carousel vert slide" data-ride="carousel" data-interval="1700">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="card-value float-right text-muted"><i class="fa fa-signal"></i></div>
                        <h3 class="mb-1">NIVEL</h3>
                    </div>
                    <div class="carousel-item">
                        <div class="card-value float-right text-muted">
                            <h3 class="mb-1"><I class="fa fa-key"></I></h3>
                        </div>
                        <h3>Uno</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-6">
        <div class="card">
            <div class="body">
                <div id="slider2" class="carousel vert slide" data-ride="carousel" data-interval="1700">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="card-value float-right text-muted"><i class="icon-screen-desktop"></i></div>
                            <h3 class="mb-1">CRIPTOGRAFIA</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="card">
    <div class="body">
        <blockquote class="blockquote mb-0">
            <p>El reto consiste en saber cuanto se enbolsillo el evo con el juancito pinto gobierno para los ninos con el bomo jauncito pinto es para escuelas fiscales</p>
            <footer class="blockquote-footer">
         <label for="txt" class="mr-2">Ingrese la bandera
        <i class="fa fa-flag"> :</i>     
        </label> 
         <input id="txt" type="text" class="text"/>
                </footer>
        </blockquote>
    </div>
</div>
@endsection 
@section('script')
@endsection
