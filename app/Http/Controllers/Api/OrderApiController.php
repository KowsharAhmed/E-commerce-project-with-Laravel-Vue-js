<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderApiController extends Controller
{
   public function store(Request $request){


    try {
        $shippingInfo = $request->shipping_info;
        Order::create([
           'product_id' => $request->product_id,
           'qty' => $request->qty,
           'price' => $request->price,
           'total_amount' => $request->qty * $request->price,
           'customer_name' => $shippingInfo['customer_name'],
           'customer_address' => $shippingInfo['address'],
           'phone' => $shippingInfo['phone'],
           'is_deliver' => false,
       ]);
       return ['success'=> true];
    }catch(\Exception $e){
        Log::error('Place order: '.$e->getMessage());
        return ['success'=> false, 'Opss! Something went worng!'];

    }
    

   }
}
