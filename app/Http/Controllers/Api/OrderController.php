<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Http\Resources\Api\OrderResource;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public const MOMO = 1;
    public const CASH = 2;
    // public const PAYMENT_MOMO = 'momo';
    // public const PAYMENT_CASH = 'cash';
    public function list(Request $request)
    {
        $token_id = $request->token_id;
        $orders = Order::with('payment', 'order_status', 'order_detail')->whereTokenId($token_id)->orderBy('id', 'DESC')->get();
        return sendResponse(OrderResource::collection($orders), 'Order success !!!');
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
                $real_price = 0;
                foreach ($order_detail as $key => $item) {
                    $product = Product::find($item['id'] ?? 0);
                    if (!empty($product)) {
                        $detail = OrderDetail::create([
                            'name' => $product->name,
                            'desc' => $product->desc,
                            'image' => $product->image,
                            'price' => $product->price,
                            'quantity' => $item['qty'],
                            'order_id' => $order->id
                        ]);
                        $real_price += $detail->price;
                        unset($detail);
                    }
                    unset($product);
                }
                $order->total = $real_price;
                $order->save();
                DB::commit();
                return sendResponse(new OrderResource($order), 'Create order success !!!');
            } else {
                DB::rollBack();
                return sendError('Create order fail !!!', [123], 200);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return sendError('Create order fail !!!', [23423], 200);
        }
    }
}
