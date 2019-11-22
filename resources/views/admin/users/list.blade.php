@extends('adminLayout.master')
@section('style')
    <link rel="stylesheet" href="{{asset('vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/sweetalert/sweetalert.css')}}" />
@endsection
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="header">
            <h2>Lista de usuarios<small>Seleccione una fila para ver detalles</small>
            </h2>
            <ul class="header-dropdown dropdown">
                <li><a href="{{ route('users/register') }}" class="btn btn-primary text-white">Registrar</a></li>
                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a>
                </li>
            </ul>
        </div>
        <div class="body">
            <div class="table-responsive">
                <table class="table table-striped table-hover dataTable js-exportable">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>id</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>id</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

  <!-- larg modal -->
<div id="detailModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Detalle de Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="d-flex flex-row justify-content-between">
                    <div>
                        <small>Registrado: 00-00-0000</small>
                    </div>
                    <div>
                        <button class="btn btn-primary">Editar</button>
                        <button class="btn btn-primary">Eliminar</button>
                    </div>
                </div>
                <div class="row pt-4 px-3">
                    <div class="col-6 form-group">
                        <strong class="text-white">Usuario:</strong>
                        <span class="">username</span>
                    </div>
                    <div class="col-6 form-group">
                        <strong class="text-white">Administrador:</strong>
                        <label class="fancy-radio custom-color-green"><input name="gender4" value="female" type="radio"
                                checked="" disabled=""><span><i></i></span></label>
                    </div>
                    <div class="col-6 form-group">
                        <strong class="text-white">Email:</strong>
                        <span class="">miemail@ctf.comsegserwgrtw</span>
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
<script>
    $(document).ready(function () {
        $(".dataTable tr").css('cursor', 'pointer');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users/list') }}",
            columns: [
                {data: 'username', name: 'username'},
                {data: 'email', name: 'email'},
                {data: 'DT_RowId', name: 'DT_RowId', visible: false}
            ]
        });
        $('.dataTable').on( 'click', 'tr', function () {
            var id = table.row( this ).id();
            if(id)
            {
                id = id.replace(/\D/g, '');
                id = parseInt(id, 10);
                console.log( 'id '+id );
                $('#detailModal').modal('show');
            }
        } );

    });



</script>
@endsection
