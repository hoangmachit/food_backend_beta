<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
                if (!empty($orderDetail)) {
                    foreach ($orderDetail as $key => $value) {
                        $value->delete();
                    }
                }
                $order->delete();
                DB::commit();
                return redirect()->route('admin.order.index')->with('success', 'Deleted order success !!!');
            } catch (\Throwable $th) {
                DB::rollBack();
                return redirect()->route('admin.order.index')->with('fail', 'Can not delete order !!!');
            }
        }
        return redirect()->route('admin.order.index')->with('fail', 'Can not delete order !!!');
    }
    public function status(Request $request)
    {
        $status = $request->status;
        $ids = $request->ids;
        if (!empty($ids)) {
            foreach ($ids as $key => $id) {
                $order = Order::find($id);
                $order->order_status_id = $status;
                $order->save();
            }
        }
        return response(true, 200);
    }
}
