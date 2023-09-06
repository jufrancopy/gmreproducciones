<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Order;


class UserOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getHistory()
    {
        return view('users.orders_history');
    }

    public function getOrder(Order $order)
    {
        if ($order->status == "0" || $order->user_id != Auth::id()) :
            return redirect('/');
        else :
            $data = ['order' => $order];
        endif;
        return view('users.order_details', $data);
    }
}
