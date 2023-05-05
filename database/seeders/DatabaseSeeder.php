<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ConfigSeeder::class,
            PaymentSeeder::class,
            OrderStatusSeeder::class,
            //ProductSeeder::class,
            OrderSeeder::class
        ]);
    }
}
