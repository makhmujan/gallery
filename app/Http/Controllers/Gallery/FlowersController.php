<?php

namespace App\Http\Controllers\Gallery;

use App\Gallery\ImageFlowers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FlowersController extends Controller
{
    private $FlowersImages;
    public function __construct(ImageFlowers $imageFlowers)
    {
        $this->FlowersImages = $imageFlowers;
    }

    function flowers() {
        return view('flowers.create');
    }

    function add(Request $request) {
        $this->validate($request, [
            'image' => 'required|image'
        ]);
        $image = $request->file('image');
        $this->FlowersImages->add($image);



        return redirect('/flowers');
    }

    function index() {

        $images = $this->FlowersImages->main();
        return view('flowers.flowers', ['imageInFlowers' => $images]);
    }

    function show($id) {
        $images = $this->FlowersImages->show($id);
        return view('flowers.showFlowers', ['imageInFlowers' => $images]);
    }

}
