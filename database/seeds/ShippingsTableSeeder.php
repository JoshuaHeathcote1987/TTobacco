<?php

use Illuminate\Database\Seeder;

class ShippingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shippings')->insert([
            'user_id' => 2,
            'first_name' => str_random(30),
            'last_name' => str_random(30),
            'address' => str_random(30),
            'address_2' => str_random(30),
            'country' => str_random(20),
            'zip' => mt_rand(0, 10),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
