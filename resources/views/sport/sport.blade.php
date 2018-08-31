@extends('layout')
@section('content')
    <div class="container">
        <div class="page">
            <a href="/">
                <h3>HOME</h3>
            </a>
            <a href="/createSport">
                <h3>ADD IMAGE</h3>
            </a>

        </div>
        <h1 align="center">Sport</h1>

        <div class="row">
            @foreach($imageInSport as $image)

                <div class="col-md-3 gallery-item">
                    <div>
                        <img src="{{$image->image}}" alt="" class="img-thumbnail">
                    </div>

                    <a href="/showSport/{{$image->id}}" class="btn btn-info my-button">Посмотреть</a>


                </div>
            @endforeach


        </div>
    </div>


@endsection