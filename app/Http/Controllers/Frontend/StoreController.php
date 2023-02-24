<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

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
}
