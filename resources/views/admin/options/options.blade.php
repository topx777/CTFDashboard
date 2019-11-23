@extends('adminLayout.master')
@section('style')
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet"href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/sweetalert/sweetalert.css')}}" />
<link rel="stylesheet" href="{{asset('vendor/summernote/dist/summernote.css')}}" />


<link rel="stylesheet" href="{{asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}"/>

<link rel="stylesheet" href="{{asset('vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css')}}"/>

<link rel="stylesheet" href="{{asset('vendor/bootstrap-multiselect/bootstrap-multiselect.css')}}"/>
<link rel="stylesheet" href="{{asset('vendor/multi-select/css/multi-select.css')}}"/>

<link rel="stylesheet" href="{{asset('vendor/nouislider/nouislider.min.css')}}"/>
<!-- VENDOR CSS -->

@endsection
@section('content')
<div class="col-lg-6 col-md-6">
        <label><b>Fecha de Inicio (dd/mm/yyyy)</b></label>
                <div class="input-group mb-3">                                        
                    <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy">
                </div>
    </div>
    <div class="col-lg-6 col-md-6">
            <label><b>Hora de Inicio</b></label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="icon-clock"></i></span>
            </div>
            <input type="text" class="form-control time24" placeholder="Ex: 23:59">
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
            <label><b>Fecha de Fin</b></label>
                    <div class="input-group mb-3">                                        
                        <input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy">
                    </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <label><b>Hora Fin</b></label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="icon-clock"></i></span>
                </div>
                <input type="text" class="form-control time24" placeholder="Ex: 23:59">
            </div>
        </div>
    
            <div class="col-md-6 mb-5">
                    <ul class="list-group">
                <li class="list-group-item">
                    Estado de la competencia
                        <div class="float-right">
                            <label class="switch">
                                <input type="checkbox">
                                    <span class="slider round"></span>
                            </label>
                        </div>
                </li>
                    </ul>                      
            </div>    
    
            <div class="col-md-12 col-lg-12">
                <h3>Reglas de juego</h3>
                <div class="card mt-3">
                    <div class="body">
                        <div class="summernote">
                            Hi dada
                            <br/><br/>
                            <p>The toolbar can be customized and it also supports various callbacks such as <code>oninit</code>, <code>onfocus</code>, <code>onpaste</code> and many more.</p>
                            <p><strong>Note:</strong> The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English</p>                                
                            <br/><br/>
                            <p>Thank you!</p>
                            <h6>Summer Note</h6>
                        </div>
                    </div>
                </div>
            </div>
        
<!-- larg modal -->

@endsection
@section('script')
<script src="{{asset('bundles/libscripts.bundle.js')}}"></script>
<script src="{{asset('bundles/vendorscripts.bundle.js')}}"></script>
<script src="{{asset('vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js')}}"></script>

<script src="{{asset('vendor/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>

<script src="{{asset('vendor/jquery.maskedinput/jquery.maskedinput.min.js')}}"></script>
<script src="{{asset('vendor/multi-select/js/jquery.multi-select.js')}}"></script>

<script src="{{asset('vendor/bootstrap-multiselect/bootstrap-multiselect.js')}}"></script>
<script src="{{asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

<script src="{{asset('vendor/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>

<script src="{{asset('vendor/nouislider/nouislider.js')}}"></script>

<script src="{{asset('bundles/mainscripts.bundle.js')}}"></script>
<script src="{{asset('js/pages/forms/advanced-form-elements.js')}}"></script>

<script src="{{asset('bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('vendor/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('vendor/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('vendor/jquery-datatable/buttons/buttons.print.min.js')}}"></script>
<script src="{{asset('vendor/sweetalert/sweetalert.min.js')}}"></script><!-- SweetAlert Plugin Js -->
{{-- <script src="{{asset('js/pages/tables/jquery-datatable.js')}}"></script> --}}
<script src="{{asset('js/pages/ui/dialogs.js')}}"></script>
<script src="{{asset('vendor/summernote/dist/summernote.js')}}"></script>



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