@extends('teamLayout.master')
@section('content')
    <div class="py-2 col-12">
        <div class="col-12">
            <h2 class="text-info">
                Tabla de Posiciones
            </h2>
            <hr class="bg-info">
        </div>
        <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-hover table-custom spacing8 text-white">
                        <thead>
                            <tr class="font-18">
                                <th class="text-center font-weight-bolder">#</th>
                                <th class="font-weight-bolder">Equipo</th>
                                <th class="text-center font-weight-bolder" >Banderas</th>
                                <th class="text-center font-weight-bolder">Puntos</th>
                            </tr>
                        </thead>
                        <tbody class="font-15" id="teamScore">
                            {{-- <tr>
                                <td class="w60 text-center">
                                   1
                                </td>
                                <td>
                                    <span>N0mb13-Equ1p0</span>
                                </td>
                                <td class="w40 px-5 text-center">
                                    4
                                </td>
                                <td class="w40 px-5 text-center">
                                    22520
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/scoreboard.js')}}"></script>
    <script>

        $(function () {
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.get("{{route('team.teamsScore')}}",
                function (data, textStatus, jqXHR) {
                    setOrden(data.teamsScoreBoard)
                },
                "JSON"
            );
        });
        function setOrden(teams) {
            if (teams.length>0) {
            let pos=1;
            $('#teamScore').html('');
            teams.forEach(team => {
                $('#teamScore').append(`
                <tr ${team.id == "{{ App\Team::getTeamID(auth()->user()->id) }}" ? 'class="text-cyan"' : ''}>
                    <td class="w60 text-center">
                        ${pos}
                    </td>
                    <td>
                        <span>${team.name}</span>
                    </td>
                    <td class="w40 px-5 text-center">
                        ${team.flag}
                    </td>
                    <td class="w40 px-5 text-center">
                        ${team.score}
                    </td>
                </tr>
                `);
                pos+=1;
            });

            }
        }
    </script>
@endsection
