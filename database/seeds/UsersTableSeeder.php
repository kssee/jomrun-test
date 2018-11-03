<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::statement("SET foreign_key_checks=0");
        \App\Models\User::truncate();
        \Illuminate\Support\Facades\DB::statement("SET foreign_key_checks=1");

        \App\Models\User::create(
            [
                'name' => 'Rex See',
                'email' => 'member@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => \Carbon\Carbon::now()
            ]
        );
    }
}
