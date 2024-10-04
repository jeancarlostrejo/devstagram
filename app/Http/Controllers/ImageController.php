<?php

namespace App\Http\Controllers;

use App\Services\UploadImageService;
use Illuminate\Http\Request;


class ImageController extends Controller
{
    public function store(Request $request)
    {
        $nameImage = UploadImageService::upload($request->file('file'),'posts');

        return response()->json(['image' => $nameImage]);
    }
}
