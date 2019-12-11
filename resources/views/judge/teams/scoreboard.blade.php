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
<div class="col-lg-12">
    <div class="card">
        <div class="header">
            <h2>Tabla de Posiciones<small>Posiciones Actualizadas en tiempo real</small>
            </h2>
            <ul class="header-dropdown dropdown">
                <li><a target="_blank"
                        href="{{ route('scoreboard', ["id" => isset($competition) && !is_null($competition) ? $competition->id : 0]) }}"
                        class="btn btn-primary text-white"> <i class="fa fa-fw fa-link"></i> Ver Tabla Publica</a>
                </li>
                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a>
                </li>
            </ul>
        </div>
        <div class="body">
            <div class="container p-5">
                <div id="teamDashboardScore">
                    <div class="row clearfix">
                        <div class="py-2 col-12">
                            <div class="col-12">
                                <div id="flip-list-demo" class="table-responsive">
                                    <table class="table table-hover table-custom spacing8 text-white">
                                        <thead>
                                            <tr class="font-18">
                                                <th class="text-center font-weight-bolder">#</th>
                                                <th class="font-weight-bolder text-left">Equipo</th>
                                                <th class="text-center font-weight-bolder">Banderas</th>
                                                <th class="text-center font-weight-bolder">Puntos</th>
                                            </tr>
                                        </thead>
                                        <tbody is="transition-group" name="flip-list">
                                            <tr v-for="team in teams" v-bind:key="team.id">
                                                <td class="w60 text-center">
                                                    @{{ team.position }}
                                                </td>
                                                <td class="text-left">
                                                    <span>@{{team.name}}</span>
                                                </td>
                                                <td class="w40 px-5 text-center">
                                                    @{{team.flags}}
                                                </td>
                                                <td class="w40 px-5 text-center">
                                                    @{{team.score}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
    window.CompetitionId = {{ $id }};
</script>
<script src="{{asset('js/scoreboard.js')}}"></script>
@endsection
