<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\User;
use DB;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('coupons')->truncate();

        $data = [];

        for ($i = 0; $i < 50; $i++) { 
            $data[] = [
                'code' => $faker->asciify('**********'),
                'value' => rand(1,1000),
                'expiry_date' => $faker->dateTime(),
            ];
        }
        DB::table('coupons')->insert($data);
    }
}