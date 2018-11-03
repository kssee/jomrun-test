<?php

use Illuminate\Database\Seeder;

class MovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        \Illuminate\Support\Facades\DB::statement("SET foreign_key_checks=0");
        \App\Models\User::truncate();
        \Illuminate\Support\Facades\DB::statement("SET foreign_key_checks=1");

        for ($i = 0; $i < 20; $i++) {
            \App\Models\Movie::create(
                [
                    'title' => ucfirst($faker->word) . ' ' . ucfirst($faker->word) . ' ' . ucfirst($faker->word) . ' ' . ucfirst($faker->word),
                    'director' => $faker->name,
                    'description' => $faker->text,
                    'banner_path' => 'images/sample_movie_poster/' . rand(1,5) . '.png',
                    'publish_at' => \Carbon\Carbon::now()->subDays(rand(1,10)),
                    'rating' => rand(1,5),
                    'comment_count' => rand(1,100),
                    'like_count' => rand(1,500),
                    'unlike_count' => rand(1,30),
                ]
            );
        }
    }
}
