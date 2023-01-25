<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProduct($id, $slug){
        $product = Product::findOrFail($id);
        // $product = Product::where('id', $id)->where('slug', $slug);
        $data = ['data' => $product];

        return view('web.product.product_single', get_defined_vars());
    }
}
