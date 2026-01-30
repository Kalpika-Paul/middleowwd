<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class ProductController extends Controller

{
    public function store(Request $request, ImageUploadService $imageService)
    {
        // Validate input
        $request->validate([
            'name' => 'required|max:155',
            'price' => 'required',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $today = now()->format('Y-m-d');      
                    $yesterday = now()->subDay()->format('Y-m-d');
                    $currentHour = now()->hour;

             
                    if ($value === $yesterday && $currentHour >= 12) {
                        $fail("You can only enter yesterday's data before 12 PM.");
                    }

                   
                    if ($value < $yesterday) {
                        $fail("You cannot enter data for days earlier than yesterday.");
                    }
                }
            ],
        ]);

        $imagePaths = $imageService->UploadMultipleImages($request->file('images'));

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->date = $request->date;
        $product->images = $imagePaths;
        $product->save();

        return redirect()->back()->with('success', 'Product Saved Successfully');
    }
}

