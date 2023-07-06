<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

use App\Mail\OrderSendDetails;
use App\Mail\OrderSendDetailsAdmin;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getOrderEmailDetails($orderId){
        $order = Order::find($orderId);
        $data = ['order'=>$order];
        Mail::to($order->getUser->email)->send(new OrderSendDetails($data));

        foreach($this->getAdminsEmails() as $admin):
            $data = ['order'=>$order, 'name'=>$admin->name.' '.$admin->lastname];
            Mail::to($admin->email)->send(new OrderSendDetailsAdmin($data));
        endforeach;
    }

    public function getAdminsEmails(){
        return User::where('role', 1)->get();
    }
}

