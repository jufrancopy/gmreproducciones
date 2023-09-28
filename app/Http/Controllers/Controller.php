<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

use Image;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

use App\Mail\OrderSendDetails;
use App\Mail\OrderSendDetailsAdmin;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getOrderEmailDetails($orderId)
    {
        $order = Order::find($orderId);
        $data = ['order' => $order];
        Mail::to($order->getUser->email)->send(new OrderSendDetails($data));

        foreach ($this->getAdminsEmails() as $admin) :
            $data = ['order' => $order, 'name' => $admin->name . ' ' . $admin->lastname];
            Mail::to($admin->email)->send(new OrderSendDetailsAdmin($data));
        endforeach;
    }

    public function getAdminsEmails()
    {
        return User::where('role', 1)->get();
    }

    public function getProcessOrder($id)
    {
        $order = Order::find($id);
        $order->o_number = $this->getOrderNumberGenerate();
        $order->status = 1;
        $order->request_at = date('Y-m-d h:i:s');
        $order->save();
    }

    public function getOrderNumberGenerate()
    {
        $orders = Order::where('status', '>', 0)->count();
        $orderNumber = $orders + 1;

        return $orderNumber;
    }

    public function postFileUpload($field, Request $request, $thumbnails = null)
    {
        $path = date('Y/m/d');
        $originalName = $request->file($field)->getClientOriginalName();
        $finalName = Str::slug($request->file($field)->getClientOriginalName() . '_' . time()) . '.' . trim($request->file($field)->getClientOriginalExtension());

        if ($request->$field->storeAs($path, $finalName, 'uploads')) :
            $data = json_encode(['upload' => 'success', 'path' => $path, 'originalName' => $originalName, 'finalName' => $finalName]);
        else :
            $data = ['upload' => 'error'];
        endif;

        if ($thumbnails) :
            $filePath = Config::get('filesystems.disks.uploads.root') . '/' . $path . '/' . $finalName;
            foreach ($thumbnails as $thumbnail) :
                $img = Image::make($filePath)->orientate();
                $img->fit($thumbnail[0], $thumbnail[1], function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save(Config::get('filesystems.disks.uploads.root') . '/' . $path . '/' . $thumbnail[2] . '_' . $finalName, 75);
            endforeach;
        endif;

        return $data;
    }

    public function getDeleteFile($disk, $file, $thumbnails = null)
    {
        $endFile =  json_decode($file, true);
        $filePath = Config::get('filesystems.disks.' . $disk . '.root') . '/' . $endFile['path'] . '/' . $endFile['finalName'];

        if (file_exists($filePath)) :

            unlink($filePath);
            if ($thumbnails) :
                foreach ($thumbnails as $thumbnail) :
                    $thumbnailPath = Config::get('filesystems.disks.' . $disk . '.root') . '/' . $endFile['path'] . '/' . $thumbnail . '_' . $endFile['finalName'];

                    if (file_exists($thumbnailPath)) :
                        unlink($thumbnailPath);
                    endif;
                endforeach;
            endif;
        endif;
    }
}
