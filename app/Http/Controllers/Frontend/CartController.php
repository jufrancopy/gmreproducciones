<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Inventory;

use Auth;

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

        $data = ['order' => $order, 'items' => $items];

        return view('frontend.cart.cart', $data);
    }

    public function getUserOrder()
    {
        $order = Order::where('status', 0)->count();
        if ($order == 0) :
            $order = new Order;
            $order->user_id = Auth::id();
            $order->save();
        else :
            $order = Order::where('status', 0)->first();
        endif;
        return $order;
    }

    public function postCartAdd(Request $request, $id)
    {
        if (is_null($request->input('inventory'))) :
            return back()
                ->with('message', 'Seleccione una opción del producto.')
                ->with('typealert', 'danger');
        else :
            $inventory = Inventory::where('id', $request->input('inventory'))->count();
            if ($inventory == 0) :
                return back()
                    ->with('message', 'La opción seleccionada no está disponible.')
                    ->with('typealert', 'danger');
            else :
                $inventory = Inventory::find($request->input('inventory'));
                if ($inventory->product_id != $id) :
                    return back()
                        ->with('message', 'No se puede agregar este producto al carrito.')
                        ->with('typealert', 'danger');
                else :
                    $order = $this->getUserOrder();
                    $product = Product::find($id);

                    if ($request->input('quantity') < 1) :
                        return back()
                            ->with('message', 'Debe ingresar la cantidad.')
                            ->with('typealert', 'danger');
                    else :
                        $orderItem = new OrderItem();
                        $total = $product->price * $request->input('quantity');
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
                        $orderItem->price_unit = $product->price;
                        $orderItem->total = $total;
                        if ($orderItem->save()) :
                            return back()
                                ->with('message', 'Producto agregado al carrito de compras.')
                                ->with('typealert', 'success');
                        endif;
                    endif;
                endif;
            endif;
        endif;
    }
}
