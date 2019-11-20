<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(OptionsSeeder::class);
        //primero las tablas que no tiene llave foranea
        $this->call(UsersSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(LevelsSeeder::class);
        //ahora las tablas que tiene foranea
        $this->call(TeamsSeeder::class);
        $this->call(ChallengesSeeder::class);
        //ahora la tablas de N-M
        $this->call(TeamsChallengesSeeder::class);
        Model::reguard();
    }
}