@extends('judgeLayout.master')
@section('style')
<link rel="stylesheet" href="{{asset('vendor/sweetalert/sweetalert.css')}}" />
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h2>
                Detalles Reto CTF
                <small>Todos los campos son sujetos a cambio.</small>
            </h2>
        </div>
        <div class="body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nombre</label>
							<input type="text" name="name" value="{{ $challenge->name }}" readonly class="form-control"
                                required maxlength="40">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Categoria</label>
                            <select class="form-control" disabled name="idCategory" required>
                                @foreach (App\Category::getCategories() as $item)
                                <option value="{{$item->id}}" @if($challenge->idCategory == $item->id) selected @endif >{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Dificultad</label>
                            <input type="text" name="dificulty" value="{{ $challenge->dificulty }}" readonly class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
							<label>Descripcion</label>
							<p>{!! $challenge->description !!}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>FLAG</label>
							<input id="flag" name="flag" value="{{ $challenge->flag }}" readonly class="form-control" placeholder="FLAG del reto" type="text">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pista</label>
                            <textarea id="hint" name="hint" readonly placeholder="Descripcion del reto" class="form-control"
							rows="5">{!! $challenge->hint !!}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <a href="{{ route('challenges.list') }}" class="btn btn-danger pull-right">
                            Atras
                            <i class="fa fa-arrow-left"></i>
						</a>
                    </div>
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
@endsection
