<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('products')->truncate();

        $data = [];

        for ($i = 0; $i < 50; $i++) { 
            $data[] = [
                'name' => $faker->name,
                'price' => rand(1,2000),
                'discount' => rand(1,2000),
                'image' => 'product-' . rand(1,5),
                'quantity' => rand(1,50),
                'tag' => $faker->word,
                'description' => $faker->text($maxNbChars = 100),
            ];
        }
        DB::table('products')->insert($data);
    }
}