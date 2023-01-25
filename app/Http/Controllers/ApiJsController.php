<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Http\Request;

use Config, Auth;

class ApiJsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('getProductsSection');
    }

    function getProductsSection($section, Request $request)
    {
        $itemsForPage = Config::get('configSite.product_per_page');
        $itemsForPageRandom = Config::get('configSite.product_per_page_random');
        switch ($section):
            case 'home':
                $products = Product::where('status', 1)->inRandomOrder()->paginate($itemsForPageRandom);
                break;
            default:
                $products = Product::where('status', 1)->inRandomOrder()->paginate($itemsForPageRandom);
                break;
        endswitch;

        return $products;
    }

    function postFavoriteAdd($object, $module, Request $request)
    {
        $query = Favorite::where('user_id', Auth::id())
            ->where('module', $module)
            ->where('object_id', $object)
            ->count();
        if ($query > 0) :
            $data = ['status' => 'error', 'msg' => 'Ya lo tienes como favorito.'];
        else :
            $favorite = new Favorite();
            $favorite->user_id = Auth::id();
            $favorite->module  = $module;
            $favorite->object_id  = $object;
            if ($favorite->save()) :
                $data = ['status' => 'success', 'msg' => 'Se guardó a su favorito'];
            endif;
        endif;
        return response()->json($data);
    }

    public function postUserFavorites(Request $request)
    {
        $objects = json_decode($request->input('objects'), true);
        $query = Favorite::where('user_id', Auth::id())
            ->where('module', $request->input('module'))
            ->whereIn('object_id', explode(",", $request->input('objects')))
            ->pluck('object_id');
            

        if (count(collect($query)) > 0) :
            $data = ['status' => 'success', 'count' => count(collect($query)), 'objects' => $query];
        else :
            $data = ['status' => 'success', 'count' => count(collect($query))];
        endif;

        return response()->json($data);
    }
}
