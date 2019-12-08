<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User; //la clase de donde esta el faker

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = new DateTime();
        //Admin
        DB::table('users')->insert([
            'id' => 1,
            'username' => 'Administrador',
            'email' => 'topx777@gmail.com',
            'email_verified_at' => $now,
            'password' => Hash::make('Admin123'),
            'role' => 0
        ]);
        // Juez
        DB::table('users')->insert([
            'id' => 2,
            'username' => 'Abel',
            'email' => 'abelopezpaniagua@gmail.com',
            'email_verified_at' => $now,
            'password' => Hash::make('Abel123'),
            'role' => 1
        ]);

        // Temas Competencia1
        DB::table('users')->insert([
            'id' => 3,
            'username' => 'Team1',
            'email' => null,
            'email_verified_at' => $now,
            'password' => Hash::make('team1abc'),
            'role' => 2
        ]);
        DB::table('users')->insert([
            'id' => 4,
            'username' => 'Team2',
            'email' => null,
            'email_verified_at' => $now,
            'password' => Hash::make('team2abc'),
            'role' => 2
        ]);
        DB::table('users')->insert([
            'id' => 5,
            'username' => 'Team3',
            'email' => null,
            'email_verified_at' => $now,
            'password' => Hash::make('team3abc'),
            'role' => 2
        ]);
        DB::table('users')->insert([
            'id' => 6,
            'username' => 'Team4',
            'email' => null,
            'email_verified_at' => $now,
            'password' => Hash::make('team4abc'),
            'role' => 2
        ]);
        //la clase llamada y el monto que se creara
        // factory(User::class, 2)->create();
    }
}
