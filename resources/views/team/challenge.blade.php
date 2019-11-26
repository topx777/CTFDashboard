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
                            <div class="card-value float-right text-muted"><i class="fa fa-key"></i></div>
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
        </blockquote>
    </div>
</div>
<div class="col-md-12">
        <div class="card">
            <div class="header">
               
                <ul class="header-dropdown dropdown">
                    
                    <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                    <li class="dropdown">
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0);">Action</a></li>
                            <li><a href="javascript:void(0);">Another Action</a></li>
                            <li><a href="javascript:void(0);">Something else</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table m-b-0">
                        <thead class="thead-light">
                            <tr>
                            <th scope="col">#</th>
                            <th></th>
                            <th scope="col">Capturas</th>
                            <th scope="col">puntos</th>
                            <th scope="col">Ayuda</th>
                            <th scope="col">Bandera</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope="row">1</th>
                            <td>Criptografia</td>
                            <td>False</td>
                            <td>100</td>
                            <td>
                                 <button class="btn btn-danger">
                                    <i class="fa fa-ambulance fa-2x"></i>
                                 </button>
                            </td>
                            <td><button class="btn btn-primary">
                                <i class="fa fa-flag"></i>    
                                -Enviar  
                            </button></td>
                            </tr>
                            <tr>
                            <th scope="row">2</th>
                            <td>Reto 2</td>
                            <td>False</td>
                            <td>100</td>
                            <td>
                                    <button class="btn btn-danger">
                                       <i class="fa fa-ambulance fa-2x"></i>
                                    </button>
                               </td>
                               <td><button class="btn btn-primary">
                                   <i class="fa fa-flag"></i>    
                                   -Enviar  
                               </button></td>
                            </tr>
                            <tr>
                            <th scope="row">3</th>
                            <td>Reto 3</td>
                            <td>False</td>
                            <td>100</td>
                            <td>
                                    <button class="btn btn-danger">
                                       <i class="fa fa-ambulance fa-2x"></i>
                                    </button>
                               </td>
                               <td><button class="btn btn-primary">
                                   <i class="fa fa-flag"></i>    
                                   -Enviar  
                               </button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection 
@section('script')
@endsection
