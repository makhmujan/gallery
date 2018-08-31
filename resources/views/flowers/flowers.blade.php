@extends('layout')
@section('content')



    <div class="container">
        <div class="page">
            <a href="/">
                <h3>HOME</h3>
            </a>
            <a href="/create">
                <h3>ADD IMAGE</h3>
            </a>
        </div>
        <h1 align="center">Flowers</h1>
        <div class="row">

            @foreach($imageInFlowers as $image)

                <div class="col-md-3 gallery-item">
                    <div>
                        <img src="{{$image->image}}" alt="" class="img-thumbnail">
                    </div>

                    <a href="/showFlowers/{{$image->id}}" class="btn btn-info my-button">Посмотреть</a>

                </div>
            @endforeach

        </div>
    </div>
@endsection