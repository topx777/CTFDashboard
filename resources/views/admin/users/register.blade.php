@extends('adminLayout.master') @section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h2>Advanced Validation</h2>
        </div>
        <div class="body">
            <form
                id="userRegister"
                method="POST"
                action="{{ route('register') }}"
                novalidate
            >
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input
                                id="username"
                                name="userData[username]"
                                autofocus
                                type="text"
                                class="form-control"
                                required
                                maxlength="40"
                            />
                            <div class="invalid-feedback">
                                El campo username es obligatorio
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Password</label>
                            <input
                                id="password"
                                name="userData[password]"
                                type="password"
                                class="form-control"
                                required
                                confirmed
                                maxlength="35"
                            />
                            <div id="p" class="invalid-feedback">
                                El campo password es obligatorio
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Confirmar contraseña</label>
                            <input
                                id="password_confirmation"
                                name="userData[password_confirmation]"
                                type="password"
                                class="form-control"
                                required
                                confirmed
                                maxlength="35"
                            />
                            <div id="pConfirm" class="invalid-feedback">
                                El campo password es obligatorio
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input
                                id="email"
                                name="userData[email]"
                                type="email"
                                class="form-control"
                                required
                                maxlength="55"
                            />
                            <div class="invalid-feedback">
                                El campo email es obligatorio
                            </div>
                        </div>
                    </div>
                    <input
                        id="admin"
                        name="userData[admin]"
                        type="hidden"
                        value="true"
                    />
                </div>

                <button type="submit" class="btn btn-primary">Registrar</button>
            </form>
        </div>
    </div>
</div>
@endsection @section('script')
<script>
    var form = document.getElementById("userRegister");
    form.addEventListener(
        "submit",
        function(event) {
            event.preventDefault();
            event.stopPropagation();
            if (form.checkValidity() === true) {
                let formURL = $(form).attr("action");
                let formData = $(form).serialize();

                $.ajax({
                    type: "POST",
                    url: formURL,
                    data: formData,
                    cache: false,
                    dataType: "JSON",
                    success: function(response) {
                        if (response.status) {
                            window.location.href = response.intended;
                        } else {
                            alert("Error");
                            console.log(response.msgError);
                            console.log(response.errors);
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }
            form.classList.add("was-validated");
        },
        false
    );
</script>
@endsection
