@extends('adminLayout.master')
@section('style')
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet"
    href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/sweetalert/sweetalert.css')}}" />
@endsection
@section('content')
    <div class="col-md-6">
            <li class="list-group-item">
                    
                    <div class="float-right">
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </li>
    </div>
    <div class="col-md-6">
            <div class="form-group">
                    <label>Ingresar reglas del CTF (Capture the flag)</label>
                    <textarea class="form-control" rows="10" cols="30" required></textarea>
                </div>
    </div>

<!-- larg modal -->

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
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.list') }}",
            columns: [
                { data: 'username', name: 'username' },
                { data: 'email', name: 'email' },
                { data: 'DT_RowId', name: 'DT_RowId', visible: false }
            ]
        });
        // row id 
        $('.dataTable').on('click', 'tr', function () {
            var id = table.row(this).id();
            if (id) {
                id = id.replace(/\D/g, '');
                id = parseInt(id, 10);
                console.log('id ' + id);
                $('#detailModal').modal('show');
            }
        });

        // confirm delete user
        $('#btnUserDelete').click(function (e) {
            e.preventDefault();
            showConfirmMessage();

        });
        function showConfirmMessage() {
            swal({
                title: "Esta seguro de eliminar al usuario?",
                text: "Esta accion no se puede deshacer!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Si, eliminar!",
                closeOnConfirm: false,
                cancelButtonText: 'Cancelar'
            }, function () {
                swal("Deleted!", "El usuario a sido eliminado", "success");
            });
        }


    });
</script>
@endsection