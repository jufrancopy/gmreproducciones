<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use Config;

class ApiJsController extends Controller
{
    function getProductsSection($section, Request $request){
        $itemsForPage = Config::get('configSite.product_per_page');
        switch($section):
            case 'home':
                $products = Product::where('status', 1)->inRandomOrder()->paginate($itemsForPage);
                break;
            default:
                $products = Product::where('status', 1)->inRandomOrder()->paginate($itemsForPage);
                break;
        endswitch;

        return $products;
    }
}
