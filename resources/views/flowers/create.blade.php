@extends('layout')

@section('content')
    <div class="container">
        <div class="page">
            <a href="flowers">
                <h3>BACK</h3>
            </a>
        </div>
        <div class="row">
            <div class="col-md-5">
                <h1>Add Image</h1>
                {{$errors->first('image')}}
                <form action="/storeFlowers" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-control">
                        <input type="file" name="image">

                    </div>
                    <button type="submit" class="btn btn-success">Add Image</button>
                </form>

            </div>
        </div>
    </div>
@endsection