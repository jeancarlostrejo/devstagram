<?php

namespace App\Services;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class UploadImageService
{
    public static function upload(UploadedFile $file, string $folder, $model = null, string $disk = 'public')
    {
        $nameImage = null;
        
        if (isset($model->image)) {
            self::delete($folder . "/". $model->image);
        }

        $nameImage = Str::uuid() . "." . $file->extension();
        $imagePath = storage_path('app/public/' . $folder) . '/' . $nameImage;

        $serverImage = Image::read($file);
        $serverImage->resize(1000, 1000);
        $serverImage->save($imagePath);

        return $nameImage;
    }

    public static function delete(string $path, string $disk = "public")
    {
        if (File::exists(Storage::path($path))) {
            Storage::disk($disk)->delete($path);
            return true;
        }

        return false;
    }
}
