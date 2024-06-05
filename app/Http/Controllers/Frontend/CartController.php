<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Inventory;
use App\Models\Coverage;
use App\Mail\OrderSendDetails;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getCart()
    {
        $order = $this->getUserOrder();
        $items = $order->getItems;
        $shipping = $this->getShippingValue($order->id);
        $order = Order::find($order->id);

        $data = ['order' => $order, 'items' => $items, 'shipping' => $shipping];

        return view('frontend.cart.cart', $data);
    }

    public function getOrderChangeType(Order $order, $type)
    {
        if ($order->user_id != Auth::id()) :
            return redirect('/');
        endif;

        if ($order->status == 0) :
            $order->o_type = $type;
            if ($type == 1) :
                $order->user_address_id = 0.00;
                $order->delivery = 0.00;
            endif;

            if ($order->save()) :
                return back();
            endif;
        else :
            return redirect('/');

        endif;
    }

    public function postCart(Request $request)
    {
        $orderId = $this->getUserOrder()->id;
        $order = Order::find($orderId);

        if ($request->input('payment_method') == 0 || $request->input('payment_method') == 1) :
            $this->getProcessOrder($order->id);
        endif;

        if ($request->input('payment_method') == 1) :
            $order->voucher = $this->postFileUpload('payment_method_transfer_file', $request);
        endif;

        $order->payment_method = $request->payment_method;
        $order->user_comment = $request->user_comment;
        $order->save();

        if ($order->save()) :
            $order = Order::find($order->id);
            if ($order->payment_method == 0 && $order->status == 1) :
                $this->getOrderEmailDetails($order->id);
                return redirect('account/history/order/' . $order->id);
            elseif ($order->payment_method == 1 && $order->status == 1) :
                $this->getOrderEmailDetails($order->id);
                return redirect('account/history/order/' . $order->id);
            else :
                return redirect('/cart/payment');
            endif;
        endif;
    }



    public function getUserOrder()
    {
        $order = Order::where('status', 0)->where('user_id', Auth::id())->count();
        if ($order == 0) :
            $order = new Order;
            $order->user_id = Auth::id();
            $order->save();
        else :
            $order = Order::where('status', 0)->where('user_id', Auth::id())->first();
        endif;
        return $order;
    }

    public function getShippingValue($orderId)
    {
        $order = Order::find($orderId);

        if ($order->o_type == 0 || Config::get('configSite.to_go') == 0) :
            $shipping_method = Config::get('configSite.shipping_method');
            if ($shipping_method == 0) :
                $price = 0.00;
            endif;

            if ($shipping_method == 1) :
                $price = Config::get('configSite.shipping_default_value');
            endif;

            if ($shipping_method == 2) :
                $user_address_count = Auth::user()->getAddress()->count();
                if ($user_address_count == 0) :
                    $price = Config::get('configSite.shipping_default_value');
                else :
                    $user_address = Auth::user()->getAddressDefault->city_id;
                    $coverage = Coverage::find($user_address);
                    $price = $coverage->price;
                endif;
            endif;

            if ($shipping_method == 3) :
                if ($order->getSubTotalOrder >= Config::get('configSite.shipping_amount_min')) :
                    $price = 0.00;
                else :
                    $price = Config::get('configSite.shipping_default_value');
                endif;
            endif;

            if (!is_null(Auth::user()->getAddressDefault)) :
                $order->user_address_id = Auth::user()->getAddressDefault->id;
            endif;
            $order->o_type = 0;
            $order->subtotal = $order->getSubtotalOrder();
            $order->delivery = $price;
            $order->total = $order->getSubtotalOrder() + $price;
            $order->save();
        else :
            $price = 0.00;
            $order->total = $order->getSubtotalOrder();
            $order->save();
        endif;

        return $price;
    }

    public function postCartAdd(Request $request, $id)
    {
        if (is_null($request->input('inventory'))) :
            return back()
                ->with('message', _sl('cart.postCartAdd.not_available'))
                ->with('typealert', 'danger');
        else :
            $inventory = Inventory::where('id', $request->input('inventory'))->count();
            if ($inventory == 0) :
                return back()
                    ->with('message', _sl('cart.postCartAdd.not_available_selected'))
                    ->with('typealert', 'danger');
            else :
                $inventory = Inventory::find($request->input('inventory'));
                if ($inventory->product_id != $id) :
                    return back()
                        ->with('message', _sl('cart.postCartAdd.cannot_be_added_to_cart'))
                        ->with('typealert', 'danger');
                else :
                    $order = $this->getUserOrder();
                    $product = Product::find($id);

                    if ($request->input('quantity') < 1) :
                        return back()
                            ->with('message', _sl('cart.postCartAdd.enter_amount'))
                            ->with('typealert', 'danger');
                    else :
                        if ($inventory->limited == 0) :
                            if ($request->input('quantity') > $inventory->quantity) :
                                return back()
                                    ->with('message', _sl('cart.postCartAdd.not_available_quantity'))
                                    ->with('typealert', 'danger');
                            endif;
                        endif;
                        if (count(collect($inventory->getVariants)) >  0) :
                            if (is_null($request->input('variant'))) :
                                return back()
                                    ->with('message', _sl('cart.postCartAdd.selected_sub_option'))
                                    ->with('typealert', 'danger');
                            endif;
                        endif;

                        if (!is_null($request->input('variant'))) :
                            $variant = Variant::where('id', $request->input('variant'))->count();
                            if ($variant == 0) :
                                return back()
                                    ->with('message', 'Selección inválida.')
                                    ->with('typealert', 'danger');
                            else :
                                $variant = Variant::find($request->input('variant'));
                                if ($variant->inventory_id != $inventory->id) :
                                    return back()
                                        ->with('message', _sl('cart.postCartAdd.invalid_selection'))
                                        ->with('typealert', 'danger');
                                endif;
                            endif;
                        endif;

                        $query = OrderItem::where('order_id', $order->id)->where('product_id', $product->id)->count();
                        if ($query == 0) :
                            $orderItem = new OrderItem();
                            $price = $this->getCalculatePrice($product->in_discount, $product->discount, $inventory->price);
                            $total = $price * $request->input('quantity');
                            if ($request->input('variant')) :
                                $variant = Variant::find($request->input('variant'));
                                $variant_label = '/' . $variant->name;
                            else :
                                $variant_label = '';
                            endif;
                            $label = $product->name . '/' . $inventory->name . $variant_label;
                            $orderItem->user_id = Auth::id();
                            $orderItem->order_id = $order->id;
                            $orderItem->product_id = $id;
                            $orderItem->inventory_id = $request->input('inventory');
                            $orderItem->variant_id = $request->input('variant');
                            $orderItem->label_item = $label;
                            $orderItem->quantity = $request->input('quantity');
                            $orderItem->discount_status = $product->in_discount;
                            $orderItem->discount = $product->discount;
                            $orderItem->discount_until_date = $product->discount_until_date;
                            $orderItem->price_initial = $inventory->price;
                            $orderItem->price_unit = $price;
                            $orderItem->total = $total;
                            if ($orderItem->save()) :
                                return back()
                                    ->with('message', _sl('cart.postCartAdd.add_product_cart'))
                                    ->with('typealert', 'success');
                            endif;
                        else :
                            return back()
                                ->with('message', _sl('cart.postCartAdd.exist_product_cart'))
                                ->with('typealert', 'danger');
                        endif;
                    endif;
                endif;
            endif;
        endif;
    }

    public function postCartItemQuantityUpdate(Request $request, $id)
    {
        $order = $this->getUserOrder();
        $oItem = OrderItem::find($id);
        $inventory = Inventory::find($oItem->inventory_id);

        if ($order->id != $oItem->order_id) :
            return back()
                ->with('message', _sl('cart.postCartAdd.not_updated_product'))
                ->with('typealert', 'danger');
        else :
            if ($inventory->limited == 0) :
                if ($request->input('quantity') > $inventory->quantity) :
                    return back()
                        ->with('message', _sl('cart.postCartAdd.not_product_availale'))
                        ->with('typealert', 'danger');
                endif;
            endif;
            $total = $oItem->price_unit * $request->input('quantity');
            $oItem->quantity = $request->input('quantity');
            $oItem->total = $total;

            if ($oItem->save()) :
                $this->getShippingValue($order->id);
                return back()
                    ->with('message', _sl('cart.postCartAdd.success_quantity_update'))
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getCartItemDelete($id)
    {
        $oItem = OrderItem::find($id);
        if ($oItem->delete()) :
            return back()
                ->with('message', _sl('cart.postCartAdd.delete_item_success'))
                ->with('typealert', 'danger');
        endif;
    }

    public function getCalculatePrice($in_discount, $discount, $price)
    {
        $finalPrice = $price;
        if ($in_discount == 1) :
            $discountValue = '0.' . $discount;
            $discountCalc = $price * $discountValue;
            $finalPrice = $price - $discountCalc;
        endif;

        return $finalPrice;
    }
}
