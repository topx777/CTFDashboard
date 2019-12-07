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
        //
        DB::table('users')->insert([
            'id' => 1,
            'username' => 'Administrador',
            'email' => 'topx777@gmail.com',
            'email_verified_at' => $now,
            'password' => Hash::make('Admin123'),
            'role' => 0
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'username' => 'Abel',
            'email' => 'abelopezpaniagua@gmail.com',
            'email_verified_at' => $now,
            'password' => Hash::make('Abel123'),
            'role' => 1
        ]);
        //la clase llamada y el monto que se creara
        // factory(User::class, 2)->create();
    }
}
