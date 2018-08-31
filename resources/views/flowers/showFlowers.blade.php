@extends('layout')
@section('content')
    <div class="container">
        <div class="page">
            <a href="/flowers">
                <h3>BACK</h3>
            </a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <img src="/{{$imageInFlowers}}" alt="" class="img-thumbnail1 gallery-image">
            </div>
        </div>
    </div>

@endsection