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
                                class="form-control username"
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
                                name="userData[password]"
                                type="password"
                                class="form-control password"
                                required
                                confirmed
                                maxlength="35"
                            />
                            <div class="invalid-feedback">
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
    $(document).on("keyup", "input", function() {
        $(this).removeClass("is-invalid");
    });

    var form = document.getElementById("userRegister");
    form.addEventListener(
        "submit",
        function(event) {
            $("input").removeClass("is-invalid");
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
                            $("#userRegister").removeClass("was-validated");
                            if (response.errorsUser !== undefined  ) {
                                let keys = Object.keys(response.errorsUser);
                                let errors = response.errorsUser;

                                let node, node2;
                                keys.forEach(key => {
                                    node = $("#userRegister").find(
                                        `input[name^="userData[${key}]"]`
                                    );
                                    if (key == "password") {
                                        node2 = $("#userRegister").find(
                                            `input[name^="userData[${key}_confirmation]"]`
                                        );
                                    }

                                    if (node !== undefined) {
                                        node.addClass("is-invalid");
                                    }
                                    if (
                                        node2 !== undefined &&
                                        key == "password"
                                    ) {
                                        node2.addClass("is-invalid");
                                    }

                                    let errores = "";
                                    errors[`${key}`].forEach(error => {
                                        errores += error + ". \n  ";
                                    });

                                    if (node !== undefined) {
                                        if (key == "password") {
                                            $(node2[0])
                                                .parent()
                                                .find(".invalid-feedback")
                                                .html(errores);
                                        }
                                        $(node[0])
                                            .parent()
                                            .find(".invalid-feedback")
                                            .html(errores);
                                    }
                                });
                            } else {
                                swal({
                                    type: "error",
                                    title: "Error",
                                    text: response.msgError
                                });
                            }

                         
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

    

    //   $(`input[name=userData[${password}]]`).parent()
</script>
@endsection
