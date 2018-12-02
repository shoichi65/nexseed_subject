<?php

use Illuminate\Database\Seeder;
use App\Feed;

class FeedsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //truncate
        Feed::truncate();

        //faker
        $faker = Faker\Factory::create('ja_JP');

        //insert
        for($i=0;$i<35;$i++)
        {
            // $feed = Feed::create();
            $feed = new Feed();

            $feed->user_id = 1;
            $feed->feed = $faker->text;

            $feed->save();
        }
    }
}
