<?php

namespace App\Http\Controllers\Gallery;


use App\Gallery\ImageCars;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    private $CarsImages;
    public function __construct(ImageCars $imageCars)
    {
       $this->CarsImages = $imageCars;
    }

    function index() {

        $images = $this->CarsImages->main();
        return view('cars.cars', ['imageInCars' => $images]);
    }

    function create() {
        return view('cars.createCars');
    }

    function show($id) {
        $images = $this->CarsImages->show($id);
        return view('cars.showCars', ['imageInCars' => $images]);
    }

    function add(Request $request) {
        $this->validate($request, [
            'image' => 'required|image'
        ]);
        $image = $request->file('image');
        $this->CarsImages->add($image);



        return redirect('/cars');
    }
}
