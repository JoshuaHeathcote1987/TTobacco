<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Aklale 100',
            'description' => str_random(100),
            'price' => 17.5,
            'gram' => 100,
            'type' => 'tobacco',
            'img' => 'Aklale100.png',
        ]);

        DB::table('products')->insert([
            'name' => 'Eyma 1000',
            'description' => str_random(100),
            'price' => 90,
            'gram' => 1000,
            'type' => 'tobacco',
            'img' => 'Eyma1000.png',
        ]);

        DB::table('products')->insert([
            'name' => 'Instark Red',
            'description' => str_random(100),
            'price' => 17.5,
            'gram' => 100,
            'type' => 'tobacco',
            'img' => 'InstarkRed100.png',
        ]);

        DB::table('products')->insert([
            'name' => 'Instark Red',
            'description' => str_random(100),
            'price' => 17.5,
            'gram' => 100,
            'type' => 'tobacco',
            'img' => 'InstarkRed100.png',
        ]);

        DB::table('products')->insert([
            'name' => 'JBX 1000',
            'description' => str_random(100),
            'price' => 110,
            'gram' => 1000,
            'type' => 'tobacco',
            'img' => 'JXB1000.png',
        ]);

        DB::table('products')->insert([
            'name' => 'Marla 100',
            'description' => str_random(100),
            'price' => 35,
            'gram' => 100,
            'type' => 'tobacco',
            'img' => 'Marla100.png',
        ]);

        DB::table('products')->insert([
            'name' => 'Watson Blue',
            'description' => str_random(100),
            'price' => 12.5,
            'gram' => 50,
            'type' => 'tobacco',
            'img' => 'Watson50Blue.png',
        ]);

        DB::table('products')->insert([
            'name' => 'Watson Grey',
            'description' => str_random(100),
            'price' => 12.5,
            'gram' => 50,
            'type' => 'tobacco',
            'img' => 'Watson50Grey.png',
        ]);

        DB::table('products')->insert([
            'name' => 'Watson Red',
            'description' => str_random(100),
            'price' => 12.5,
            'gram' => 50,
            'type' => 'tobacco',
            'img' => 'Watson50Red.png',
        ]);

        DB::table('products')->insert([
            'name' => 'Watson Red 200',
            'description' => str_random(100),
            'price' => 27.5,
            'gram' => 100,
            'type' => 'tobacco',
            'img' => 'Watson50Red.png',
        ]);
    }
}
