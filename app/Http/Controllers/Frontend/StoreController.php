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
}
