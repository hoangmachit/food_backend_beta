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
                'image'  => 'xe-tap-di-fisher-price-new-98-cday-du-phu-kien-8803.jpg',
                'status' => 1,
                'user_id' => 1
            ]);
        }
    }
}
