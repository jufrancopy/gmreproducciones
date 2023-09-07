<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;

class InfonetController extends Controller
{


    protected $except = [
        'payment',
    ];
    // --------- SEGUN BANCARD ---------
    // $tid, identificador unico de la transacion requerido
    //$prd_id identificador unico de la factura (opcional) // utilizaremos para esto el id de la orden
    //$sub_id identificador unico del cliente/compra requerido // utilizaremos para esto el id de la orden // que supongo va ser el dato que se da al cliente al realiar una compra, o usamos su cedula?
    //$addl datos adicionales (opcional)
    public function invoices(Request $request, $tid, $prd_id = null, $sub_id, $addl = null)
    {
        $var = 'ok';
        //query all order 
        $order = null;
        if ($prd_id != null) {
            $order = Order::where('id', $prd_id)->first();
        } else {
            $order = Order::where('id', $sub_id)->first();
        }

        //TO DO
        //convertir en el formato que pide infonet
        //hacer la validacion de los errores

        return response()->json($order);
    }


    public function payment(Request $request)
    {
        // Do something with the payment data...
        $datos = $request->all();

        $tid = $request->input('tid'); // este dato se DEBE guardar para poder hacer la reversion

        $prd_id = $request->input('prd_id');
        $sub_id = $request->input('sub_id');
        $amt = $request->input('amt');
        $inv_id = $request->input('inv_id');
        $curr = $request->input('curr');
        $trn_dat = $request->input('trn_dat');
        $trn_hou = $request->input('trn_hou');
        $cm_amt = $request->input('cm_amt');
        $addl = $request->input('addl');
        $cm_curr = $request->input('cm_curr');
        $barcode = $request->input('barcode');



        return response()->json(['status' => 'success']);
    }

    public function reverse(Request $request)
    {

        $datos = $request->all();
        //obligatorio
        $tid = $request->input('tid'); // se recupera de la db el tid que se guardo en el pago

        //opcionales
        $prd_id = $request->input('prd_id');
        $sub_id = $request->input('sub_id');
        $amt = $request->input('amt');
        $inv_id = $request->input('inv_id');
        $curr = $request->input('curr');
        $trn_dat = $request->input('trn_dat');
        $trn_hou = $request->input('trn_hou');
        $cm_amt = $request->input('cm_amt');
        $addl = $request->input('addl');
        $cm_curr = $request->input('cm_curr');
        $barcode = $request->input('barcode');

        return response()->json(['status' => 'success']);
    }
}
