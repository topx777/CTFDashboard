@extends('adminLayout.master')
@section('style')
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet"
    href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/sweetalert/sweetalert.css')}}" />
<link rel="stylesheet" href="{{asset('vendor/summernote/dist/summernote.css')}}" />


<link rel="stylesheet" href="{{asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" />

<link rel="stylesheet" href="{{asset('vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css')}}" />

<link rel="stylesheet" href="{{asset('vendor/bootstrap-multiselect/bootstrap-multiselect.css')}}" />
<link rel="stylesheet" href="{{asset('vendor/multi-select/css/multi-select.css')}}" />

<link rel="stylesheet" href="{{asset('vendor/nouislider/nouislider.min.css')}}" />
<link rel="stylesheet" href="{{asset('vendor/dropify/css/dropify.min.css')}}" />
<!-- VENDOR CSS -->

@endsection
@section('content')
<div id="main-content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <h2>Cargar Archivo</h2>
                    <form action="" method="POST" class="">
                        <div class="body">
                            <input type="file" class="dropify">
                        </div>
                        <div class="text-right">
                            <button type="button" class="btn btn-success btn-round mt-3">Subir Archivo</button>
                            <button type="button"
                                class="btn btn-sm btn-primary btn-round btn-danger mt-3">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('bundles/libscripts.bundle.js')}}"></script>
<script src="{{asset('bundles/vendorscripts.bundle.js')}}"></script>
<script src="{{asset('vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js')}}"></script>
<script src="{{asset('vendor/dropify/js/dropify.js')}}"></script>
<script src="{{asset('js/pages/forms/dropify.js')}}"></script>



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

@endsection