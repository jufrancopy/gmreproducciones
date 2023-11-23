<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\User, App\Models\Product;

class DashboardController extends Controller
{
    public function __construct(){
        // $this->middleware('auth');
        // $this->middleware('user.status');
        // $this->middleware('user.permissions');
        // $this->middleware('isadmin');
    }

    public function getDashboard(){
        $today = date('Y-m-d 00:00:00');
        $today_end = date('Y-m-d 23:59:59');
        $users = User::count();
        $products = Product::where('status', 1)->count();
        $orders = Order::whereBetween('paid_at', [$today, $today_end])->get();
        $data = ['users' => $users, 'products'=>$products, 'orders'=>$orders];
        
        return view ('admin.dashboard', $data);
    }
}


