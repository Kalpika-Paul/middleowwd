<?php

namespace App\Services;

use Illuminate\Support\Str;



class ImageUploadService{

    public function UploadMultipleImages(array $images, string $folder = 'upload/products'){

        $imagePaths = [ ];

        foreach($images as $image){
            $fileName = Str::uuid(). '.' . $image->getClientOriginalExtension();
            $image -> move(public_path($folder),$fileName);

            $imagePaths[] = $folder . '/' .$fileName;
        }

        return $imagePaths;

    }

}

