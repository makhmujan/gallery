<?php
namespace App\Gallery;

use Illuminate\Support\Facades\DB;

class ImageCars
{
    public function main()
    {
        $images = DB::table('cars_images')->select('*')->get();
        $carsImages = $images -> all();

        return $carsImages;
    }

    public function show($id)
    {
        $image = DB::table('cars_images')->select('*')->where('id', $id)->first();
        return $image->image;
    }

    public function add($image)
    {
        DB::table('cars_images')->insert(
            ['image' => $image->store('uploads')]
        );
    }
}