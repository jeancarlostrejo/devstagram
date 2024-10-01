<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;


class ImageController extends Controller
{
    public function store(Request $request)
    {
        $image = $request->file('file');

        $nameImage = Str::uuid() . "." . $image->extension();
        $imagePath = storage_path('app/public/posts') . '/' . $nameImage;

        $serverImage = Image::read($image);
        $serverImage->resize(1000,1000);
        $serverImage->save($imagePath);

        return response()->json(['image' => $nameImage]);
    }
}
