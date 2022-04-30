<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\User;
use DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('orders')->truncate();

        $users = User::all()->pluck('id');
        $products = Product::all()->pluck('id');
        $coupons = Coupon::all()->pluck('id');

        $data = [];

        for ($i = 0; $i < 50; $i++) { 
            $data[] = [
                'user_id' => $users->random(),
                'product_id' => $products->random(),
                'coupon_id' => $coupons->random(),
                'name' => $users->name,
                'email' => $users->email,
                'phone' => $users->phone,
                'postCode' => $faker->postcode,
                'streetAddress' => $faker->streetAddress,
                'country' => $faker->country,
                'city' => $faker->city,
                'quantity' => $products->quantity,
                'note' => $faker->text($maxNbChars = 40),
                'total_fee' => $faker->rand(5000,10000),
            ];
        }
        DB::table('orders')->insert($data);
    }
}