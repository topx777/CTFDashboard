@extends('adminLayout.master')
@section('style')
<link rel="stylesheet" href="{{asset('vendor/sweetalert/sweetalert.css')}}" />
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h2>
                Agregar un nuevo Reto CTF
                <small>Llena todos los campos son necesarios</small>
            </h2>
        </div>
        <div class="body">
            <form id="registerChallengeForm" action="{{ route('challenges.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="name" class="form-control" placeholder="Ingrese Nombre del Reto"
                                required maxlength="40">
                            <div class="invalid-feedback">
                                Este Campo es necesario
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Categoria</label>
                            <select class="form-control" name="idCategory" required>
                                @foreach (App\Category::getCategories() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Este Campo es necesario
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nivel</label>
                            <select class="form-control" name="idLevel" required>
                                @foreach (App\Level::getLevels() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Este Campo es necesario
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Descripcion</label>
                            <textarea id="description" name="description" placeholder="Descripcion del reto"
                                class="form-control" rows="10"></textarea>
                            <div class="invalid-feedback">
                                Este Campo es necesario
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <table class="table table-striped table-inverse table-responsive table-sm"
                            style="max-height: 270px; overflow-y: scroll">
                            <thead class="thead-inverse">
                                <tr>
                                    <th> </th>
                                    <th>Nombre</th>
                                    <th>Tamaño</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody id="filesList">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>FLAG</label>
                            <input id="flag" name="flag" class="form-control" placeholder="FLAG del reto" type="text">
                            <div class="invalid-feedback">
                                Este Campo es necesario
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pista</label>
                            <textarea id="hint" name="hint" placeholder="Descripcion del reto" class="form-control"
                                rows="5"></textarea>
                            <div class="invalid-feedback">
                                Este Campo es necesario
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success pull-right">
                            Guardar
                            <i class="fa fa-save"></i>
                        </button>
                        <a href="{{ route('challenges.list') }}" class="btn btn-danger pull-right">
                            Cancelar
                            <i class="fa fa-close"></i>
                        </a>
                    </div>
                </div>
            </form>
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

        var formChallenge = document.getElementById('registerChallengeForm');
        formChallenge.addEventListener('submit', function (event) {
            event.preventDefault();
            event.stopPropagation();
            if (formChallenge.checkValidity() == true) {

                let formChallenge = this;

                $(formChallenge).find('button').prop('disabled', true);
                let method = $(formChallenge).attr('method');
                let action = $(formChallenge).attr('action');

                $.ajax({
                    type: method,
                    url: action,
                    data: $(formChallenge).serialize(),
                    dataType: "JSON",
                    success: function (response) {
                        if (response.status) {
                            swal({
                                type: 'success',
                                title: 'Correcto',
                                text: 'Reto registrado con exito'
                            });
                            location.href = "{{ route('challenges.list') }}";
                        } else {
                            $(formChallenge).removeClass('was-validated');
                            if (response.validationErrors !== undefined) {
                                let keys = Object.keys(response.validationErrors);
                                let errors = response.validationErrors;
                                keys.forEach(key => {
                                    let node = $(formChallenge).find(
                                        `input[name=${key}]`);
                                    let node2 = $(formChallenge).find(
                                        `textarea[name=${key}]`);
                                    console.log(node, node2);
                                    if (node !== undefined) {
                                        node.addClass('is-invalid');
                                    } else if (node2 !== undefined) {
                                        node2.addClass('is-invalid');
                                    }
                                    let = errores = "";
                                    errors[`${key}`].forEach(error => {
                                        errores += error + '\n';
                                    });
                                    if (node !== undefined) {
                                        $(node[0]).parent().find(
                                            '.invalid-feedback').html(errores);
                                    } else if (node2 !== undefined) {
                                        $(node2[0]).parent().find(
                                            '.invalid-feedback').html(errores);
                                    }
                                });

                            } else {
                                swal({
                                    type: 'error',
                                    title: 'Error',
                                    text: response.msgError
                                });
                            }
                        }
                    },
                    error: function (err) {
                        console.log(err);
                        swal({
                            type: 'error',
                            title: 'Error',
                            text: 'Error Desconocido'
                        });
                    },
                    complete: function () {
                        $(formChallenge).find('button').prop('disabled', false);
                    }
                });
            }
            formChallenge.classList.add('was-validated');
        }, false);

    });

    $(document).on('click', '.selectFile', async function () {
        let button = $(this);
        let url = button.data('url');

        swal({
            title: "Elegir...",
            text: "Ingrese el nombre del link del archivo:",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: true,
            inputPlaceholder: "Nombre Link"
        }, function (inputValue) {
            if (inputValue === false) return false;
            if (inputValue === "") {
                swal.showInputError("El Campo es requerido");
                return false
            }

            let template =
                `<a href="${url}" download>${inputValue}</a>`;

            $('#description').val($('#description').val() + ' ' + template);
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
                    filesList.unshift(file);
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

        filesHTML.fadeOut().html('');
        let filesHTMLstr = ""

        filesList.forEach(function (file, index) {
            filesHTMLstr += `
            <tr>
                <td>
                    <i class="fa fa-lg ${getExtensionIcon(file.ext)}"></i>
                </td>
                <td>${file.name}.${file.ext}</td>
                <td>${parseFloat(file.size / 1024).toFixed(2)}kb</td>
                <td>
                    <button type="button" data-url="${file.url}" class="btn btn-round btn-sm btn-primary selectFile" title="Seleccionar">
                        <i class="fa fa-arrow-left"></i>
                    </button>     
                </td>
            </tr>
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

</script>
@endsection
