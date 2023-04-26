<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderStatus;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order_status = [
            [
                'name' => 'Mới đặt hàng'
            ],
            [
                'name' => 'Chờ nhận hàng'
            ],
            [
                'name' => 'Đã có hàng'
            ],
            [
                'name' => 'Đã nhận hàng'
            ],
            [
                'name' => 'Hoàn thành'
            ]
        ];
        foreach ($order_status as $key => $item) {
            OrderStatus::create($item);
        }
    }
}
