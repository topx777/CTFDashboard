@extends('adminLayout.master')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h2>Advanced Validation</h2>
        </div>
        <div class="body">
            <form id="userRegister" method="POST" action="{{ route('register') }}" novalidate>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input name="username" autofocus type="text" class="form-control" required maxlength="40" >
                            <div class="invalid-feedback">
                                El campo username es obligatorio
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Password</label>
                            <input name="password" type="password" class="form-control" required maxlength="35">
                            <div class="invalid-feedback">
                                El campo password es obligatorio
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input name="email" type="email" class="form-control" required maxlength="55">
                            <div class="invalid-feedback">
                                El campo email es obligatorio
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <br>
                            <div class="fancy-checkbox">
                                <label><input name="admin" type="checkbox"><span>Administrador</span></label>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Registrar</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
            var form=document.getElementById('userRegister');
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                event.stopPropagation();
                if (form.checkValidity() === true) {
                    alert('valido')

                }
                form.classList.add('was-validated');
            }, false);
    </script>
@endsection
