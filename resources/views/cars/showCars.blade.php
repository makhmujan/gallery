@extends('layout')
@section('content')
    <div class="container">
        <div class="page">
            <a href="/cars">
                <h3>BACK</h3>
            </a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <img src="/{{$imageInCars}}" alt="" class="img-thumbnail1 gallery-image">
            </div>
        </div>
    </div>

@endsection