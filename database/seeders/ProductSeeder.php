<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 0; $x <= 10; $x++) {
            DB::table('product')->insert([
                'name' => 'Sản phẩm ' . $x,
                'desc' => Str::random(20),
                'price'  => mt_rand(1000, 99000),
                'image'  => $x . '.jpg',
                'status' => 1,
                'status_payment' => 0,
                'buy' => 0,
                'user_id' => 1
            ]);
        }
    }
}
