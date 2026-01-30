<?php

namespace App\Services;

use Illuminate\Support\Str;

class ImageUploadService
{

    public function UploadMultipleImages(array $images, string $folder = 'upload/products')
    {
        $imagePaths = [];
        $count = 1;
    
        foreach ($images as $image) {
            $fileName = 'p_'.$count .'.' . $image->getClientOriginalExtension();
            $image->move(public_path($folder), $fileName);
            $imagePaths[] = $folder . '/' . $fileName;

            $count++;
        }
    
        return $imagePaths;
    }
    
}
