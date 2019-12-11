@extends('teamLayout.master')
@section('style')
    <style>
        .flip-list-move {
            transition: transform 1s;
        }
    </style>
@endsection
@section('content')
    <div class="py-2 col-12">
        <div class="col-12">
            <h2 class="text-info">
                Tabla de Posiciones
            </h2>
            <hr class="bg-info">
        </div>
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
                        <tr class="team" v-for="team in teams" v-bind:key="team.id">
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
@endsection
@section('script')
    <script>
        window.CompetitionId={{$id}};
    </script>
    <script src="{{asset('js/scoreboard.js')}}"></script>
    <script>

        // $(function () {
        //     $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        //     });
        //     $.get("{{route('team.teamsScore')}}",
        //         function (data, textStatus, jqXHR) {
        //             setOrden(data.teamsScoreBoard)
        //         },
        //         "JSON"
        //     );
        // });
        // function setOrden(teams) {
        //     if (teams.length>0) {
        //     let pos=1;
        //     $('#teamScore').html('');
        //     teams.forEach(team => {
        //         $('#teamScore').append(`
        //         <tr ${team.id == "{{ App\Team::getTeamID(auth()->user()->id) }}" ? 'class="text-cyan"' : ''}>
        //             <td class="w60 text-center">
        //                 ${pos}
        //             </td>
        //             <td>
        //                 <span>${team.name}</span>
        //             </td>
        //             <td class="w40 px-5 text-center">
        //                 ${team.flag}
        //             </td>
        //             <td class="w40 px-5 text-center">
        //                 ${team.score}
        //             </td>
        //         </tr>
        //         `);
        //         pos+=1;
        //     });

        //     }
        // }
    </script>
@endsection
