<?php
namespace App\Gallery;

use Illuminate\Support\Facades\DB;

class ImageSport
{
    public function main()
    {
        $images = DB::table('sport_images')->select('*')->get();
        $sportImages = $images -> all();

        return $sportImages;
    }

    public function show($id)
    {
        $image = DB::table('sport_images')->select('*')->where('id', $id)->first();
        return $image->image;
    }

    public function add($image)
    {
        DB::table('sport_images')->insert(
            ['image' => $image -> store('uploads')]
        );
    }
}