<?php
namespace App\Gallery;

use Illuminate\Support\Facades\DB;

class ImageAnimals
{
    public function animals()
    {
        $images = DB::table('animals_images')->select('*')->get();
        $animalsImages = $images -> all();

        return $animalsImages;
    }

    public function add($image)
    {
        DB::table('animals_images')->insert(
            ['image' => $image -> store('uploads')]
        );
    }

    public function show($id)
    {
        $image = DB::table('animals_images')->select('*')->where('id', $id)->first();
        return $image->image;
    }
}