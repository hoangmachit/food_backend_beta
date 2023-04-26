<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('config')->insert([
            'name' => 'store_name',
            'value' => 'AGL Food',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('config')->insert([
            'name' => 'momo_phone_number',
            'value' => '0969874264',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('config')->insert([
            'name' => 'momo_name',
            'value' => 'Hoang Mach Van',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('config')->insert([
            'name' => 'momo_email',
            'value' => 'hoangmach.website@gmail.com',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('config')->insert([
            'name' => 'store_start_time',
            'value' => '10:00',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('config')->insert([
            'name' => 'store_end_time',
            'value' => '10:45',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('config')->insert([
            'name' => 'open_store',
            'value' => 'on',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
