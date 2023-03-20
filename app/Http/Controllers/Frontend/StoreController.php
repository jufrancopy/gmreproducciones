<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config, Auth;

use App\Models\Category;
use App\Models\Product;

class StoreController extends Controller
{
    public function getStore(){
        $categories = Category::where('module', 0)->where('parent', 0)->orderBy('order', 'ASC')->get();

        $data = ['categories'=>$categories];

        return view('frontend.store.home', $data);
    }

    public function getCategory($id, $slug){
        $category = Category::findOrFail($id);
        $categories = $categories = Category::where('module', 0)->where('parent', $id)->orderBy('order', 'ASC')->get();

        $data = ['categories'=>$categories,'category'=>$category];

        return view('frontend.store.category', $data);
    }

    public function postSearch(Request $request){
        
        $products = Product::where('status', 1)->where('name', 'LIKE', '%'.$request->input('search_query').'%')->get();
        $data = ['query'=> $request->input('search_query'), 'products'=>$products];
        
        return view('frontend.store.search', $data);
    }
}
