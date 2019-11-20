<?php

use Illuminate\Database\Seeder;
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
            'username' => 'Marcelo',
            'email' => 'marcelo@hotmail.com',
            'email_verified_at' => $now,
            'password' => Hash::make('Marcelo123'),
            'admin' => true
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'username' => 'Abel',
            'email' => 'abel@hotmail.com',
            'email_verified_at' => $now,
            'password' => Hash::make('Abel123'),
            'admin' => true
        ]);
        DB::table('users')->insert([
            'id' => 3,
            'username' => 'Pablo',
            'email' => 'pablo@hotmail.com',
            'email_verified_at' => $now,
            'password' => Hash::make('Pablo123'),
            'admin' => true
        ]);
        DB::table('users')->insert([
            'id' => 4,
            'username' => 'Christopher',
            'email' => 'christopher@hotmail.com',
            'email_verified_at' => $now,
            'password' => Hash::make('Christopher123'),
            'admin' => true
        ]);
        DB::table('users')->insert([
            'id' => 5,
            'username' => 'Rodrigo',
            'email' => 'rodrigo@hotmail.com',
            'email_verified_at' => $now,
            'password' => Hash::make('Rodrigo123'),
            'admin' => true
        ]);
        DB::table('users')->insert([
            'id' => 6,
            'username' => 'Luis',
            'email' => 'luis@hotmail.com',
            'email_verified_at' => $now,
            'password' => Hash::make('Luis123'),
            'admin' => true
        ]);
        //la clase llamada y el monto que se creara
        factory(User::class, 5)->create();
    }
}
