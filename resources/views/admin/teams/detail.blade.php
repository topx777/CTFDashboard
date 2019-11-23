@extends('adminLayout.master')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
        </div>
        <div class="body">
            <ul class="nav nav-tabs2 justify-content-end">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#tabDetailTeam">Detalle</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabEditTeam">Editar</a></li>
                <li class="nav-item"><a class="nav-link">Eliminar</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show vivify pullUp active" id="tabDetailTeam">
                    <h6>Detalle de Equipo</h6>
                    <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt
                        tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor,
                        williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh
                        dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex
                        squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan
                        american apparel, butcher voluptate qui.</p>
                </div>
                <div class="tab-pane vivify pullUp" id="tabEditTeam">
                    <h6>Edicion detalles de Equipo</h6>
                    <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out
                        mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade.
                        Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard
                        locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy
                        irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi
                        whatever gluten-free, carles pitchfork biodiesel </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    var form = document.getElementById('userRegister');
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