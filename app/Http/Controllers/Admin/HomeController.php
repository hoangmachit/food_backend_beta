<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Order;
use App\Models\OrderDetail;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $date  = !empty($request->date) ? Carbon::parse($request->date) :  Carbon::now();
        $orders = Order::with('order_detail')->whereDate('created_at', '=', $date)->orderBy('id', 'DESC')->get();
        $totalFood = 0;
        $totalPrice = 0;
        foreach ($orders as $key => $order) {
            $totalPrice += $order->total;
            $order_details = $order->order_detail;
            foreach ($order_details as $key => $detail) {
                if ((int)$detail->price > 0) {
                    $totalFood += $detail->quantity;
                }
            }
        }
        $orderDetails = OrderDetail::selectRaw('product_id, SUM(quantity) as quantity')
            ->whereDate('created_at', '=', $date)
            ->distinct()
            ->with('Product')
            ->groupBy('product_id')
            ->get();
        return view('admin.index', [
            'orders' => $orders,
            'date' => $date,
            'orderDetails' => $orderDetails,
            'totalFood' => $totalFood,
            'totalPrice' => $totalPrice
        ]);
    }
}
