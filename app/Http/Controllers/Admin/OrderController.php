<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();


                            // CREATE SUMMARY
                            // Sistem of laravel
        // $summary = DB::table('orders')
        // ->join('products','products.id','=','orders.product_id')
        // ->select(
        //     'orders.product_id',
        //     'products.name',
        //     DB::raw('SUM(orders.qty) AS total_qty'),
        //     DB::raw('SUM(orders.total_amount) AS total_amount')
        // )->groupBy('orders.product_id.')
        // ->orderByDesc('total_qty')
        // ->first();
        // dd( $summary);


    

    //    $summary = DB::select(DB::raw('SELECT
    //    orders.product_id,
    //    products.name,
    //    SUM(orders.qty) AS total_qty,
    //    SUM(orders.total_amount) AS total_amount
    //    FROM
    //       orders
    //    JOIN products ON products.id = orders.product_id
    //    GROUP BY
    //       orders.product_id
    //    ORDER BY
    //       total_qty
    //    DESC
    //    LIMIT 1'));

    //    dd($summary);





        return view('admin.orders.index', compact('orders',));
    }


    public function changeStatus($id){
       try {
            $order = Order::find($id);
            $order->is_deliver = true;
            $order->update();
            return redirect()->back()->with('success','Order delivery status changed');
       }catch(\Exception $e){
            return redirect()->back()->with('error','Unable to change delivery status');

       }

    }
}
