<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Models\Order;
use App\Mail\AdminNotifyUserOrderStatusChange;

use function PHPUnit\Framework\isNull;

class OrderController extends Controller
{
    public function getHistory()
    {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function getList($status, $type)
    {
        if ($status == 'all') :
            if ($type == 'all') :
                $orders = Order::where('status', '!=', 0)->with('getUser')->orderBy('o_number', 'DESC')->paginate(10);
            else :
                $orders = Order::where('status', '!=', 0)->where('o_type', $type)->with('getUser')->orderBy('o_number', 'DESC')->paginate(10);
            endif;

        else :
            if ($type == 'all') :
                $orders = Order::where('status', $status)->with('getUser')->orderBy('o_number', 'DESC')->paginate(10);
            else :
                $orders = Order::where('status', $status)->where('o_type', $type)->with('getUser')->orderBy('o_number', 'DESC')->paginate(10);
            endif;
        endif;

        $allOrders = Order::select(['id', 'status'])->get();

        $data = ['orders' => $orders, 'status' => $status, 'type' => $type, 'allOrders' => $allOrders];
        return view('admin.orders.list', $data);
    }

    public function getOrder(Order $order)
    {
        $data = ['order' => $order];

        return view('admin.orders.view', $data);
    }

    public function postOrderStatusUpdate(Order $order, Request $request)
    {
        if ($request->status == 1 || $request->status == 2 || $order->status == 6 || $order->status == 100) :
            return back();
        else :
            $order->status = $request->status;

            if ($request->status == 3 && is_null($order->process_at)) :
                $order->process_at = date('Y-m-d h:i:s');
            endif;
            if ($request->status == 4 && is_null($order->send_at)) :
                $order->send_at = date('Y-m-d h:i:s');
            endif;
            if ($request->status == 5 && is_null($order->send_at)) :
                $order->send_at = date('Y-m-d h:i:s');
            endif;
            if ($request->status == 6 && is_null($order->delivery_at)) :
                $order->delivery_at = date('Y-m-d h:i:s');
            endif;
            if ($request->status == 100 && is_null($order->rejected_at)) :
                $order->rejected_at = date('Y-m-d h:i:s');
            endif;


            if ($order->save()) :
                $user = $order->getUser;
                $data = ['name' => $order->name, 'email' => $user->email, 'status' => $request->status, 'o_number' => $order->o_number];
                Mail::to($user->email)->send(new AdminNotifyUserOrderStatusChange($data));
                return back()
                    ->with('message', ' Orden guardado con éxito.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }
}
