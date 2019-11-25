@extends('teamLayout.master')
@section('content')
<div class="col-12 py-3">
<h4>
    Bienvenido
</h4>
</div>
<div class="col-6">
    <div class="card">
        <div class="card-body d-flex justify-content-center flex-column align-content-center align-items-center">
            <div>
                <h5>N0mbr3_Equ1p0</h5>
            </div>
            <div style="width:300px; height: 400px" class=" rounded bg-white">
                imagen
            </div>
            <div>
                <hr>
                <div>
                    <strong>Couch:</strong>
                    <span>NOmbre Apellido Couch</span>
                </div>
                <p class=" py-2">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates consequuntur quo soluta, numquam accusamus praesentium impedit. Corrupti maiores, officiis quia nemo, doloremque blanditiis delectus eius ducimus rem distinctio, hic velit.
                </p>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h6>Integrantes de Equipo</h6>
        </div>
        <ul class="list-group">
            <li class="list-group-item">
                <div>
                    <strong>Nombre:</strong>
                    <span>NombreIntegrante ApellidosInte</span>
                </div>
                <div class="d-flex flex-row">
                    <div>
                        <strong>Universidad:</strong>
                        <span>Nombre de Universidad</span>
                    </div>
                    &nbsp;
                    <div>
                        <strong>Carrera:</strong>
                        <span>CarreraUNiversidad</span>
                    </div>
                </div>
                <div>
                    <strong>Correo:</strong>
                    <span>Correo@dominio.com</span>
                </div>
            </li>
            <li class="list-group-item">
                <div>
                    <strong>Nombre:</strong>
                    <span>NombreIntegrante ApellidosInte</span>
                </div>
                <div class="d-flex flex-row">
                    <div>
                        <strong>Universidad:</strong>
                        <span>Nombre de Universidad</span>
                    </div>
                    &nbsp;
                    <div>
                        <strong>Carrera:</strong>
                        <span>CarreraUNiversidad</span>
                    </div>
                </div>
                <div>
                    <strong>Correo:</strong>
                    <span>Correo@dominio.com</span>
                </div>
            </li>
            <li class="list-group-item">
                <div>
                    <strong>Nombre:</strong>
                    <span>NombreIntegrante ApellidosInte</span>
                </div>
                <div class="d-flex flex-row">
                    <div>
                        <strong>Universidad:</strong>
                        <span>Nombre de Universidad</span>
                    </div>
                    &nbsp;
                    <div>
                        <strong>Carrera:</strong>
                        <span>CarreraUNiversidad</span>
                    </div>
                </div>
                <div>
                    <strong>Correo:</strong>
                    <span>Correo@dominio.com</span>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="col-6">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <span>Inicio:</span>
                    <h4>08:00</h4>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <span>Fin:</span>
                    <h4>12:00</h4>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <span>Puntos:</span>
                    <H4>100000</H4>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class=" card-body">
            <h5>Reglas CTF</h5>
            <hr>

        </div>
    </div>
</div>
@endsection
