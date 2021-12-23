<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductApiController extends Controller
{
    public function getProducts(){
        $products = Product::all();
        return $products;


    }
    public function getProductBySlug(string $slug){
        $product = Product::where('slug',$slug)->first();
        return $product;

    }
}
