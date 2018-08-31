<?php

namespace App\Http\Controllers\Gallery;

use App\Gallery\ImageSpace;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpaceController extends Controller
{
    private $SpaceImages;
    public function __construct(ImageSpace $imageSpace)
    {
        $this->SpaceImages = $imageSpace;
    }

    function space() {

        $image = $this->SpaceImages->main();
        return view('space.space', ['imageInSpace' => $image]);
    }

    function add(Request $request) {
        $this->validate($request, [
            'image' => 'required|image'
        ]);
        $image = $request->file('image');
        $this-> SpaceImages -> add($image);

        return redirect('/space');
    }

    function show($id) {
        $image = $this->SpaceImages->show($id);
        return view('space.showSpace', ['imageInSpace' => $image]);
    }

    function create() {
        return view('space.createSpace');
    }
}
