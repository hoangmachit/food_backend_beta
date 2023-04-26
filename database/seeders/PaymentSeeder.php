<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment')->insert([
            'name' => 'MOMO'
        ]);
        DB::table('payment')->insert([
            'name' => 'CASH'
        ]);
    }
}
