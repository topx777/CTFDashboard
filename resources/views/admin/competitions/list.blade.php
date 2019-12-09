@extends('adminLayout.master')
@section('style')
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/sweetalert/sweetalert.css')}}" />
<link rel="stylesheet" href="{{asset('vendor/bootstrap-multiselect/bootstrap-multiselect.css')}}">
<link rel="stylesheet" href="{{asset('vendor/multi-select/css/multi-select.css')}}">
<link rel="stylesheet" href="{{asset('vendor/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
@endsection
@section('content')
<div class="col-lg-12">
<div class="card">
    <div class="header">
        <h2>Habilitar competencia Principal 
            <small>Seleccione Competencias</small>
        </h2>
    </div>
    <div class="body">
        <div class="row">
            <div class="col-4">
                <div class="multiselect_div">
                    <select id="selectCompetition" name="multiselect4[]" class="multiselect multiselect-custom"
                        multiple="multiple">
                        @foreach ($competitions as $competition)
                        <option value="{{$competition->id}}">{{$competition->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4">
                <button class="btn btn-info">Enviar</button>
            </div>
        </div>
        <small>*Las competencias seleccionadas no seran deshabilitadas</small>
    </div>
</div>
</div>
<div class="col-lg-12">
    <div class="card">
        <div class="header">
            <h2>Lista de Competencias<small>Seleccione una competencia para ver detalles</small>
            </h2>
            <ul class="header-dropdown dropdown">
                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a>
                </li>
            </ul>
        </div>
        <div class="body">
            <div class="table-responsive">
                <table class="table table-striped table-hover dataTable js-exportable">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Deshabilitado</th>
                            <th>Dificultad</th>
                            <th>Modo juego</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Deshabilitado</th>
                            <th>Dificultad</th>
                            <th>Modo juego</th>
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
<script src="{{asset('vendor/multi-select/js/jquery.multi-select.js')}}"></script><!-- Multi Select Plugin Js -->
<script src="{{asset('vendor/bootstrap-multiselect/bootstrap-multiselect.js')}}"></script>
<script src="{{asset('vendor/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
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
        
        $('#selectCompetition').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            maxHeight: 200
        });

        var table = $('.dataTable').DataTable({
            language: {
                url: "{{asset('lenguage/Spanish.json')}}"
            },
            processing: true,
            serverSide: true,
            ajax: "{{ route('competitions.list') }}",
            columns: [
                { data: 'name', name: 'name' },
                { data: 'state', name: 'state',render: function (state) { return (state == 0)?'<span class="badge badge-danger">No Iniciado</span>':'<span class="badge badge-success">En Juego</span>' } },
                { data: 'masterDisabled', name: 'masterDisabled', render: function (disabled) { return (disabled == 1)?'<i class="icon-ban text-danger font-weight-bold"></i>&nbsp;Desahabilitado':'<i class="icon-check text-success font-weight-bold"></i>&nbsp;Habilitado'}},
                { data: 'dificulty', name: 'dificulty',render: function (dificulty) { 
                                                                                    var badge;
                                                                                        if(dificulty==0)
                                                                                            badge ='<span class="badge badge-info">facil</span>';
                                                                                        if(dificulty== 1)
                                                                                            badge ='<span class="badge badge-success">medio</span>';
                                                                                        if(dificulty== 2)
                                                                                            badge ='<span class="badge badge-warning">dificil</span>';
                                                                                        if(dificulty== 3)
                                                                                            badge ='<span class="badge badge-danger">extremo</span>';
                                                                                    return badge;}},
                { data: 'gameMode', name: 'gameMode',render: function (mode) { return (mode == 0)?'<i class="icon-user font-weight-bold"></i>&nbsp;Presencial':'<i class="icon-globe font-weight-bold"></i>&nbsp;Remoto' } },
                { data: 'DT_RowId', name: 'DT_RowId', visible: false }
            ]
        });

        // row id 
        $('.dataTable').on('click', 'tr', function () {
            var id = table.row(this).id();
            if (id) {
                id = id.replace(/\D/g, '');
                id = parseInt(id, 10);
                var url = '{{ route("competitions.detail", "") }}';
                url+=`/${id}`
                window.location.href=url;

            }
        });



    });

    function setItemsCompetition() {
        $.get("{{route('competitions.list')}}",
            function (data, textStatus, jqXHR) {
                var list='';
                data.data.forEach(competition => {
                    list+=`<option value="${competition.id}">${competition.name}</option>`
                });
                console.log(list)
                $('#selectCompetition').html(list);
            },
            "JSON"
        );
    }

</script>
@endsection