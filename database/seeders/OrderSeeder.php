<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\User;
use App\Models\Coupon;
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
        $coupons = Coupon::all()->pluck('id');

        $data = [];

        for ($i = 0; $i < 50; $i++) { 
            $data[] = [
                'user_id' => $users->random(),
                'coupon_id' => $coupons->random(),
                'name' => $faker->name,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'postCode' => $faker->postcode,
                'streetAddress' => $faker->streetAddress,
                'country' => $faker->country,
                'city' => $faker->city,
                'quantity' => rand(1,30),
                'note' => $faker->text($maxNbChars = 40),
                'total_fee' => rand(5000,10000),
            ];
        }
        DB::table('orders')->insert($data);
    }
}