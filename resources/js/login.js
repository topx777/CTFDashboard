$(document).on('submit', '#loginForm', function (e) {

    e.preventDefault();

    let form = $(this);
    let formURL = $(form[0]).attr('action');


    let formData = new FormData(form[0]);

    $.ajax({
        type: "POST",
        url: formURL,
        data: formData,
        processData: false,
        contentType: false,
        dataType: "JSON",
        success: function (response) {
            if (response.auth) {
                window.location.href = response.intended;
            } else {
                alert('Credenciales incorrectos');
            }
        },
        error: function (err) {
            console.log(err);
        }
    });

});
