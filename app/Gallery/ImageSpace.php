<?php
namespace App\Gallery;

use Illuminate\Support\Facades\DB;

class ImageSpace
{
    public function main()
    {
        $images = DB::table('space_images')->select('*')->get();
        $spaceImages = $images -> all();

        return $spaceImages;
    }

    public function add($image)
    {
        DB::table('space_images')->insert(
            ['image' => $image->store('uploads')]
        );
    }

    public function show($id)
    {
        $image = DB::table('space_images')->select('*')->where('id', $id)->first();
        return $image->image;
    }
}