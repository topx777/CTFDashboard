@extends('teamLayout.master')
@section('content')

    <div class="col-lg-6">

    
<div class="card">
    <div class="body">
        <div id="slider2" class="carousel vert slide" data-ride="carousel" data-interval="1700">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="card-value float-right text-muted"><i class="wi wi-fog"></i></div>
                    <h3 class="mb-1">12°C</h3>
                    <div>London</div>
                </div>
                <div class="carousel-item">
                    <div class="card-value float-right text-muted"><i class="wi wi-day-cloudy"></i></div>
                    <h3 class="mb-1">18°C</h3>
                    <div>New York</div>
                </div>
                <div class="carousel-item">
                    <div class="card-value float-right text-muted"><i class="wi wi-sunrise"></i></div>
                    <h3 class="mb-1">37°C</h3>
                    <div>New Delhi</div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection 
@section('script')
@endsection
