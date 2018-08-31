<?php

namespace App\Http\Controllers\Gallery;


use App\Gallery\ImageSport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SportController extends Controller
{
    private $SportImages;
    public function __construct(ImageSport $imageSport)
    {
        $this->SportImages = $imageSport;
    }

    function index() {
        $images = $this->SportImages->main();
        return view('sport.sport', ['imageInSport' => $images]);
    }

    function show($id) {
        $image = $this->SportImages->show($id);
        return view('sport.showSport', ['imageInSport' => $image]);
    }

    function create() {
        return view('sport.createSport');
    }

    function add(Request $request) {
        $this->validate($request, [
            'image' => 'required|image'
        ]);
        $image = $request->file('image');
        $this -> SportImages -> add($image);



        return redirect('/sport');
    }
}
