<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ImageUploadService;
use GuzzleHttp\Handler\Proxy;
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


    public function edit($id)
    {
        $product = Product::findOrFail($id); 
        return view('edit', compact('product'));
    }
    
    public function update(Request $request, ImageUploadService $imageService, $id)
    {
        $product = Product::findOrFail($id);
    
        $request->validate([
            'name' => 'required|max:155',
            'price' => 'required',
            'images' => 'sometimes|array', // 'sometimes' allows it to be optional
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
    
        
        if ($request->hasFile('images')) {
            $imagePaths = $imageService->UploadMultipleImages($request->file('images'));
            $product->images = $imagePaths;
        }
    
        $product->name = $request->name;
        $product->price = $request->price;
        $product->date = $request->date;
        $product->save();
    
        return redirect()->route('admin.dashboard')->with('success', 'Product edited Successfully');
    }
    


    public function delete(Request $request, $id)
    {
  
        $product = Product::findOrFail($id);
    
      
        if ($product->images && is_array($product->images)) {
            foreach ($product->images as $img) {
                if (file_exists(public_path($img))) {
                    unlink(public_path($img));
                }
            }
        }
    
        $product->delete();
    
       
        return redirect()->back()->with('success', 'Product deleted successfully');
    }
    
        
    }




