<?php

namespace App\Http\Controllers\Gallery;


use App\Gallery\ImageAnimals;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnimalsController extends Controller
{
    private $AnimalsImages;

    public function __construct(ImageAnimals $imageAnimals)
    {
        $this->AnimalsImages = $imageAnimals;
    }

    function animals() {

        $image = $this->AnimalsImages->animals();
        return view('animals.animals', ['imageInAnimals' => $image]);
    }

    function add(Request $request) {

        $this->validate($request, [
            'image' => 'required|image'
        ]);
        $image = $request->file('image');
        $this->AnimalsImages->add($image);

        return redirect('/animals');
    }

    function show($id) {
        $images = $this->AnimalsImages->show($id);
        return view('animals.showAnimals', ['imageInAnimals' => $images]);
    }

    function create() {
        return view('animals.createAnimals');
    }
}
