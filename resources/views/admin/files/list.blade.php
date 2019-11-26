@extends('adminLayout.master')
@section('style')
<link rel="stylesheet" href="{{asset('vendor/sweetalert/sweetalert.css')}}" />
<!-- VENDOR CSS -->
@endsection
@section('content')

<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal" id="uploadFileModal">
    <div class="modal-dialog">
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
                                <form id="uploadFileForm" action="{{ route('files.upload') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="body">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="name">Nombre del Archivo</label>
                                                <input type="text" class="form-control" name="name" id="name"
                                                    placeholder="Nombre del Archivo">
                                                <div class="invalid-feedback">
                                                    Campo requerido
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="file">Archivos</label>
                                                <input type="file" name="file" class="form-control">
                                                <div class="invalid-feedback">
                                                    Campo requerido
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-success btn-round mt-3">Subir
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
                        data-target="#uploadFileModal" ata-backdrop="static" data-keyboard="false">
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
                    filesList.push(file);
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

    $(document).on('click', '.deleteFile', function () {
        let button = $(this);
        let id = button.data('id');
        let index = button.data('pos');

        swal({
            title: 'Esta seguro de eliminar el archivo?',
            text: "Esta accion no se puede deshacer!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "Si, eliminar!",
            closeOnConfirm: true,
            cancelButtonText: 'Cancelar'
        }, function () {

            $.ajax({
                type: "POST",
                url: "{{ route('files.delete') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                dataType: "JSON",
                success: function (response) {
                    if (response.status) {
                        swal({
                            type: 'success',
                            title: 'Correcto',
                            text: 'Archivo Eliminado con exito'
                        });
                        filesList.splice(index, 1);
                        syncFiles();
                    } else {
                        swal({
                            type: 'error',
                            title: 'Error',
                            text: response.msgError
                        });
                    }
                },
                error: function (err) {
                    console.log(err);
                    swal({
                        type: 'error',
                        title: 'Error',
                        text: 'Error Desconocido, intente nuevamente'
                    });
                }
            });
        });

    });

    function syncFiles() {

        filesHTML.fadeOut().html('');
        let filesHTMLstr = ""

        filesList.forEach(function (file, index) {
            filesHTMLstr += `
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <i class="fa fa-5x ${getExtensionIcon(file.ext)}"></i>
                        <h5 class="card-title mt-3">${file.name}.${file.ext}</h5>
                        <p class="card-text">${parseFloat(file.size / 1024).toFixed(2)}kb</p>
                        <div class="btn-group-sm">
                            <a href="${file.url}" download class="btn btn-success" title="Descargar">
                                <i class="fa fa-download"></i>
                            </a>
                            <button type="button" class="btn btn-danger deleteFile" data-pos="${index}" data-id="${file.id}" title="Eliminar">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            `;
        });

        filesHTML.fadeIn().html(filesHTMLstr);
    }

    function getExtensionIcon(ext) {
        let icon = '';
        switch (ext) {
            case 'txt':
                icon = 'fa-file-text-o';
                break;
            case 'img':
                icon = 'fa-file-image-o';
                break;
            case 'pdf':
                icon = 'fa-file-pdf-o';
                break;
            case 'pptx':
                icon = 'fa-file-powerpoint-o';
                break;
            case 'docx':
                icon = 'fa-file-word-o';
                break;
            case 'xlsx':
                icon = 'fa-file-excel-o';
                break;
            case 'png':
                icon = 'fa-file-image-o';
                break;
            case 'jpg':
                icon = 'fa-file-image-o';
                break;
            case 'jpeg':
                icon = 'fa-file-image-o';
                break;
            case 'ico':
                icon = 'fa-file-image-o';
                break;
            case 'bmp':
                icon = 'fa-file-image-o';
                break;
            default:
                icon = 'fa-file-archive-o';
                break;
        }

        return icon;
    }


    $(document).on('submit', '#uploadFileForm', function (e) {
        let form = $(this);

        e.preventDefault();
        e.stopPropagation();

        $(form).find('button').prop('disabled', true);

        let formData = new FormData;

        formData.append('_token', form.find('input[name=_token]').val());
        formData.append('name', form.find('input[name=name]').val());
        formData.append('file', form.find('input[name=file]')[0].files[0]);

        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (response) {
                if (response.status) {
                    swal({
                        type: 'success',
                        title: 'Correcto',
                        text: 'Archivo Subido con exito'
                    });
                    filesList.unshift(response.file);
                    $('#uploadFileModal').modal('hide');
                    $('.modal-backdrop.show').remove();
                } else {
                    if (response.errors != undefined) {
                        let errors = response.errors;
                        let errorKeys = Object.keys(errors);

                        errorKeys.forEach(element => {
                            let msgError = "";
                            errors[`${element}`].forEach(error => {
                                msgError += (error + "\n");
                            });

                            $(form).find(`input[name=${element}]`).addClass('is-invalid');
                            $(form).find(`input[name=${element}]`).parent().find(
                                '.invalid-feedback').text(msgError);
                        });
                    }
                    swal({
                        type: 'error',
                        title: 'Error',
                        text: response.msgError
                    });
                }
            },
            error: function (err) {
                console.log(err);
                swal({
                    type: 'error',
                    title: 'Error',
                    text: 'Error desconocido.'
                });
            },
            complete: function () {
                syncFiles();
                $(form).find('button').prop('disabled', false);
            }
        });

    });

    $(document).on('keyup change', 'input', function () {
        $(this).removeClass('is-invalid');
    });

    $(document).on('hide.bs.modal', '#uploadFileModal', function () {
        $(this).find('input').toArray().forEach(element => {
            $(element).removeClass('is-invalid');
            $(element).parent().find('.invalid-feedback').html('El campo es requerido');
        });
        document.getElementById('uploadFileForm').reset();
    });

</script>


@endsection
