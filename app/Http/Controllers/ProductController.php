<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([

            'name' => 'required|max:155',
            'price' => 'required',

        ]);

        $product = new Product();

        $product->name = $request->name;
        $product->price = $request->price;
        $product->date = $request->date;


        
        $product->save();
    }
}
