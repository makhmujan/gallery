<?php
namespace App\Gallery;


use Illuminate\Support\Facades\DB;


class ImageFlowers
{
    public function main()
    {
        $images = DB::table('flowers_images')->select('*')->get();
        $flowersImages = $images -> all();

        return $flowersImages;

    }

    public function add($image)
    {
        DB::table('flowers_images')->insert(
            ['image' => $image -> store('uploads')]
        );
    }

    public function show($id)
    {
        $image = DB::table('flowers_images')->select('*')->where('id', $id)->first();
        return $image->image;
    }

}