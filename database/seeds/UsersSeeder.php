<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //truncate
        User::truncate();

        //faker
        $faker = Faker\Factory::create('ja_JP');

        //insert
        for($i=0;$i<35;$i++)
        {
            // $user = User::create();
            $user = new User();

            $user->name = $faker->userName();
            $user->email = $faker->unique()->email();
            $user->password = Hash::make($user->email);

            $user->save();
        }
    }
}
