<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slider;

class ContentController extends Controller
{
    public function getHome(){
        $categories = Category::where('module', 0)->where('parent', 0)->orderBy('order', 'ASC')->get();
        $sliders = Slider::where('status', 1)->orderBy('s_order', 'ASC')->get();
        $data = ['categories'=>$categories, 'sliders'=>$sliders];

        return view('home', $data);
    }
}
