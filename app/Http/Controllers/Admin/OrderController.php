<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;

class OrderController extends Controller
{
    public function getHistory()
    {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function getList($status)
    {
        if ($status == 'all') :
            $orders = Order::where('status', '!=', 0)->paginate(30);
        else :
            $orders = Order::where('status', $status)->paginate(30);
        endif;

        $data = ['orders' => $orders, 'status' => $status];
        return view('admin.orders.list', $data);
    }
}
