<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = [
            [
                'token_id' => Str::random(15),
                'user_name' => "Nguyễn Văn A",
                'phone_number' => '0909160056',
                'total' => "28000",
                'order_status_id' => 1,
                'payment_id' => 1
            ],
            [
                'token_id' => Str::random(15),
                'user_name' => "Nguyễn Văn B",
                'phone_number' => '0123456789',
                'total' => "53000",
                'order_status_id' => 1,
                'payment_id' => 2
            ],
            [
                'token_id' => Str::random(15),
                'user_name' => "Nguyễn Văn C",
                'phone_number' => '1234567890',
                'total' => "25000",
                'order_status_id' => 1,
                'payment_id' => 2
            ],
            [
                'token_id' => Str::random(15),
                'user_name' => "Nguyễn Văn D",
                'phone_number' => '0969874264',
                'total' => "50000",
                'order_status_id' => 1,
                'payment_id' => 1
            ]
        ];
        foreach ($orders as $key => $order) {
            $orderId = DB::table('order')->insertGetId($order);
            if ($orderId) {
                $product = Product::find($orderId);
                DB::table('order_detail')->insert([
                    'order_id'=> $orderId,
                    'name' => $product->name,
                    'desc' => $product->desc,
                    'image' => $product->image,
                    'price' => $product->price,
                    'quantity' => 1,
                ]);
            }
        };
        die;
    }
}
