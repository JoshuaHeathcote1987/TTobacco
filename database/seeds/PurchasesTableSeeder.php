<?php

use Illuminate\Database\Seeder;

class PurchasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {            
        DB::table('purchases')->insert([
            'user_id' => 2,
            'item_id' => 2,
            'shipping_id' => 1,
            'amount' => 2,
            'sent' => true,
        ]);
    }
}
