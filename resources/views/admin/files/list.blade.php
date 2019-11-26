@extends('adminLayout.master')
@section('style')
<link rel="stylesheet" href="{{asset('vendor/sweetalert/sweetalert.css')}}" />
<link rel="stylesheet" href="{{asset('vendor/dropify/css/dropify.min.css')}}" />
<!-- VENDOR CSS -->
@endsection
@section('content')

<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="uploadFileModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Subir Archivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="card">
                                <form id="uploadFileForm" action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data">
                                    <div class="body">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="name">Nombre del Archivo</label>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Nombre del Archivo">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <input type="file" class="dropify">
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="button" class="btn btn-success btn-round mt-3">Subir
                                            Archivo</button>
                                        <button type="button" data-dismiss="modal"
                                            class="btn btn-sm btn-primary btn-round btn-danger mt-3">Cancelar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h3>Administrador de Archivos</h3>
                    <p class="text-cyan">Lista de todos los archivos alojados en el servidor</p>
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal"
                        data-target="#uploadFileModal">
                        Subir Archivo
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="filesList" class="row">

            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('bundles/libscripts.bundle.js')}}"></script>

<script src="{{asset('bundles/vendorscripts.bundle.js')}}"></script>

<script src="{{asset('vendor/dropify/js/dropify.js')}}"></script>

<script src="{{asset('bundles/mainscripts.bundle.js')}}"></script>

<script src="{{asset('vendor/sweetalert/sweetalert.min.js')}}"></script><!-- SweetAlert Plugin Js -->

<script>
    let filesHTML = null;

    let filesList = [];

    $(document).ready(function () {

        filesHTML = $('#filesList');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        loadFiles();


        $('.dropify').dropify();

        var drEvent = $('#dropify-event').dropify();
        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Estas seguro de Eliminar \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element) {
            alert('Archivo Eliminado');
        });

    });

    function loadFiles() {

        $.ajax({
            type: "GET",
            url: "{{ route('files.getAll') }}",
            data: {
                _token: "{{ csrf_token() }}",
            },
            dataType: "JSON",
            cache: false,
            success: function (data) {
                data.forEach(file => {
                    filesList.add(file);
                });
            },
            error: function (err) {
                console.log(err);
            },
            complete: function () {
                syncFiles();
            }
        });

    }


    function syncFiles() {

        filesHTML.html('');
        let filesHTMLstr = ""

        filesList.forEach(file => {
            filesHTMLstr += `
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <i class="fa fa-5x fa-file-text"></i>
                        <h5 class="card-title mt-3">Archivo</h5>
                        <p class="card-text">200kb</p>
                        <div class="btn-group-sm">
                            <button type="button" class="btn btn-success" title="Delete">
                                <i class="fa fa-download"></i>
                            </button>
                            <button type="button" class="btn btn-danger" title="Delete">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            `;
        });

        filesHTML.html(filesHTMLstr);
    }


    $(document).on('submit', '#uploadFileForm', function(e) {
        let form = $(this);
        e.preventDefault();
        e.stopPropagation();


    });


</script>


@endsection
