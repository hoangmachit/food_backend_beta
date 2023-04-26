<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use DB;

class OrderController extends Controller
{
    public const MOMO = 1;
    public const CASH = 2;
    public function list(Request $request)
    {
        $token_id = $request->token_id;
        $orders = Order::with('payment', 'order_status', 'order_detail')->whereTokenId($token_id)->get();
        return response($orders, 200);
    }
    public function create(Request $request)
    {
        $token_id = $request->token_id;
        $order_payment = $request->order_payment;
        $order_detail = $request->order_detail;
        $user_name = $request->user_name;
        $total_price = $request->total_price;
        $phone_number = $request->phone_number;
        DB::beginTransaction();
        $order = Order::create([
            'token_id' => $token_id,
            'user_name' => $user_name,
            'phone_number' => $phone_number,
            'total' => $total_price,
            'payment_id' => $order_payment == 'cash' ? self::CASH : self::MOMO,
            'order_status_id' => 1
        ]);
        try {
            if (!empty($order)) {
                $order_detail = json_decode($order_detail, true);
                foreach ($order_detail as $key => $item) {
                    $product = Product::find($item['id'] ?? 0);
                    if (!empty($product)) {
                        OrderDetail::create([
                            'name' => $product->name,
                            'desc' => $product->desc,
                            'image' => $product->image,
                            'price' => $product->price,
                            'quantity' => $item['qty'],
                            'order_id' => $order->id
                        ]);
                    }
                }
            }
            DB::commit();
            return response($order->id, 200);
        } catch (\Throwable $th) {
            DB::rollBack();
        }
        return response(false, 200);
    }
}