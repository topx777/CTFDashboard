@extends('teamLayout.master')
@section('style')
<style>
.disable{
    background-color: #22252a !important;
}
</style>
@endsection
@section('content')
<div class="col-12 py-3">
    <div>
        <h2 class="text-info text-center">Retos</h2>
    </div>
    <div id="divLevels" class="col-12">

    </div>

</div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.getJSON("{{Route('team.teamChallenges')}}",{
                _token:"{{csrf_token()}}"
            },
                function (data, textStatus, jqXHR) {
                    console.log(data);
                    setLevelsChallenges(data.level)
                }
            ); 

        });
        function setLevelsChallenges(levels) {
            if (levels.length > 0) {
                $('#divLevels').html('');
                levels.forEach(level => {
                    let vlevel='';
                    vlevel+=` <div class="level py-2">
                                <div class="col-12">
                                    <h5 class=" text-info">${level.name}</h5>
                                     <hr class=" bg-info">
                                </div>
            <div class="row">`;
                level.challenges.forEach(challenge => {
                    vlevel+=`<div class="col-12 col-sm-4 col-md-3">
                                <div class="card">
                                    <div class="header">
                                        <h2><span class="icon-fire"></span>${challenge.category[0].name}</h2>
                                    </div>
                                    <div class="${(level.lock)?'disable':''} body">
                                        <div class="text-center">${challenge.name}</div>
                                        <br>
                                    </div>
                                </div>
                            </div>`;});
            
        level+=`</div>
    </div>`;
$('#divLevels').append(vlevel);
});

            }
        }

        
    </script>
@endsection