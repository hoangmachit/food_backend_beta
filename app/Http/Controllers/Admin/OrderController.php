<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('payment', 'order_status', 'order_detail')->get();
        return view('admin.order.index', [
            'orders' => $orders
        ]);
    }
    public function delete(Request $request, $id = 0)
    {
        $order = Order::find($id);

        if (!empty($order)) {
            DB::beginTransaction();
            try {
                $orderDetail = OrderDetail::whereOrderId($id)->get();
                foreach ($orderDetail as $key => $value) {
                    # code...
                }
                dd($orderDetail);
                die;
            } catch (\Throwable $th) {
                DB::rollBack();
            }
        }
    }
}
