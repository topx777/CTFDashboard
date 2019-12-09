@extends('judgeLayout.master')
@section('style')
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet"
    href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/sweetalert/sweetalert.css')}}" />
<style>
    tbody tr {
        cursor: pointer;
    }
</style>
@endsection
@section('content')
<div class="col-lg-4">
    <div class="card">
        <div class="header">
            <h2>
                Registrar Reto<small>Llenar los datos para registrar el reto a la competencia.</small>
            </h2>
        </div>
        <div class="body">
            @if(isset($competition) && !is_null($competition))
            <form id="formChallengeRegister" action="{{ route('competitionChallenge.store') }}" method="POST">
                @csrf
                <input type="hidden" name="idCompetition" id="idCompetition" value="{{ app('request')->has('idCompetition') ? app('request')->input('idCompetition') : 0 }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Reto</label>
                            <input type="text" id="challenge" disabled class="form-control">
                            <input type="hidden" id="idChallenge" name="idChallenge" class="form-control">
                            <div class="invalid-feedback">
                                Este Campo es necesario
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="idLevel">Nivel</label>
                            <select id="idLevel" class="form-control" name="idLevel">
                                @foreach ($competition->Levels->sortBy('order') as $level)
                                    <option value="{{$level->id}}"> {{$level->name}} </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Este Campo es necesario
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button id="send" type="submit" class="btn btn-success btn-block">Asignar Reto</button>
                    </div>
                </div>
            </form>
            @else
            <h3>No se encontro la competencia</h3>
            @endif
        </div>
    </div>
</div>
<div class="col-lg-8">
    <div class="card">
        <div class="header">
            <h2>Lista de Retos<small>Seleccione un item agreagar a la competencia</small>
            </h2>
            <ul class="header-dropdown dropdown">
                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
            </ul>
        </div>
        <div class="body">
            <div class="table-responsive">
                <table id="challengesTable" class="table table-striped table-hover dataTable js-exportable">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Flag</th>
                            <th>Pista</th>
                            <th>Dificultad</th>
                            <th>Categoria</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Flag</th>
                            <th>Pista</th>
                            <th>Dificultad</th>
                            <th>Categoria</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('vendor/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('vendor/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('vendor/jquery-datatable/buttons/buttons.print.min.js')}}"></script>
<script src="{{asset('vendor/sweetalert/sweetalert.min.js')}}"></script><!-- SweetAlert Plugin Js -->
{{-- <script src="{{asset('js/pages/tables/jquery-datatable.js')}}"></script> --}}
<script src="{{asset('js/pages/ui/dialogs.js')}}"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.dataTable').DataTable({
            language: {
                url: "{{asset('lenguage/Spanish.json')}}"
            },
            processing: true,
            serverSide: true,
            ajax: "{{ route('challenges.list') }}",
            columns: [
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description' },
                { data: 'flag', name: 'flag' },
                { data: 'hint', name: 'hint' },
                { data: 'dificulty', name: 'dificulty' },
                { data: 'idCategory', name: 'idCategory' },
                { data: 'DT_RowId', name: 'DT_RowId', visible: false }
            ]
        });

        $('#challengesTable').on('click', 'tr', function () {
            var id = table.row(this).id();

            swal({
                title: "Desea elegir este reto?",
                text: "Este sera el reto que se utilizara en la competencia",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Si, Elegir!",
                closeOnConfirm: true,
                cancelButtonText: 'Cancelar'
            }, function () {
                $.ajax({
                    type: "GET",
                    url: "{{ route('challenges.get') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    cache: false,
                    dataType: "JSON",
                    success: function (data) {
                        $('#formChallengeRegister').find('#challenge').val(data.name);
                        $('#formChallengeRegister').find('#idChallenge').val(data.id);
                    },
                    error: function(err) {
                        console.log(err);
                        swal("Error!", "Error Desconocido", "error");
                    }
                });
            });
        });

        $(document).on('submit', '#formChallengeRegister', function(e) {
            e.preventDefault();
            e.stopPropagation();

            let action = $(this).attr('action');
            let method = $(this).attr('method');

            let form = $(this);
            let formData = form.serialize();

            let button = $('#send');

            button.prop('disabled', true);

            $.ajax({
                type: method,
                url: action,
                data: formData,
                dataType: "JSON",
                success: function (response) {
                    if(response.status) {
                        swal({
                            type: "success",
                            title: "Correcto",
                            text: "Reto Agregrado Correctamente!"
                        });
                        window.location.href = "{{ route('competitionChallenge.list', ['idCompetition' => app('request')->has('idCompetition') ? app('request')->input('idCompetition') : 0]) }}";
                    } else {
                        swal({
                            type: "error",
                            title: "Error",
                            text: response.msgError
                        });
                    }
                },
                error: function (err) {
                    console.log(err);
                    swal({
                        type: 'error',
                        title: 'Alerta',
                        text: 'Error desconocido, intente nuevamente'
                    });
                },
                complete: function () {
                    button.prop('disabled', false);
                }
            });
        });

    });
</script>
@endsection
