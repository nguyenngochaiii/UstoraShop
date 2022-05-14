<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('users')->truncate();

        $data = [];

        for ($i = 0; $i < 50; $i++) { 
            $data[] = [
                'name' => $faker->name,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'username' => $faker->bothify('user##??'),
                'password' => $faker->bothify('user##??'),
                'postCode' => $faker->postcode,
                'streetAddress' => $faker->streetAddress,
                'country' => $faker->country,
                'city' => $faker->city,
                'date_of_birth' => $faker->datetime,
                'sex' => $faker->title($gender = 'male'|'female'),
                'role_as' => 0,
                'avatar' => $faker->imageUrl($width = 640, $height = 480),
            ];
        }
        DB::table('users')->insert($data);
    }
}