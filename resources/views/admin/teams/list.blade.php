@extends('adminLayout.master')

@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="header">
            <h2>Lista de Equipos<small>Seleccione una fila para ver detalles</small>
            </h2>
            <ul class="header-dropdown dropdown">
                <li><a href="{{ route('teams/register') }}" class="btn btn-primary text-white">Registrar</a></li>
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
                            <th>Puntuación</th>
                            <th>Couch</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Puntuación</th>
                            <th>Couch</th>
                            <th>Acciones</th>
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
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let token = "{{ csrf_token() }}";

        var table = $('.dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('teams/list') }}",
                type: 'POST',
                data: {
                    _token: token
                }
            },
            columns: [
                {data: 'name', name: 'name'},
                {data: 'score', name: 'score'},
                {data: 'couch', name: 'couch'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

    });

    // Typing timeout
    var typingTimeout = null;
    // On keyup
    $("#datatable-search").keyup(function() {
        // Clear previous timer
        clearTimeout(typingTimeout);
        // Set a new timer
        var that = this;
        typingTimeout = setTimeout(function(){
            $(".dataTable").DataTable().search($(that).val()).draw();
        }, 200); // Execute the search if user paused for 200 ms
    });


</script>
@endsection
