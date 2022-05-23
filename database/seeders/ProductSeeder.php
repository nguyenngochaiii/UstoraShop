<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\User;

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
                'name' => 'IPhone' . rand(11,13) . ' Pro Max',
                'price' => rand(1500,2000),
                'discount' => rand(1000,1500),
                'image' => 'product-' . rand(1,5),
                'quantity' => rand(1,50),
                'tag' => $faker->word,
                'detail' => $faker->text($maxNbChars = 50),
                'description' => $faker->text($maxNbChars = 100),
            ];
        }
        DB::table('products')->insert($data);
    }
}