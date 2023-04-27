<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public const STATUS_ORRDER = 2;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $orders = Order::with('order_detail')->whereOrderStatusId(self::STATUS_ORRDER)->get();
        $totalFood = 0;
        $totalPrice = 0;
        foreach ($orders as $key => $order) {
            $totalPrice+=$order->total;
            $order_details = $order->order_detail;
            foreach ($order_details as $key => $detail) {
                $totalFood+=$detail->quantity;
            }
        }
        return view('admin.index', [
            'orders' => $orders,
            'totalFood' => $totalFood,
            'totalPrice' => $totalPrice
        ]);
    }
}
