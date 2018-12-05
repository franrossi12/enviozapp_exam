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
        $user = [ "email" => "test@gmail.com" ];
       // set fillable property first on User model
        factory(App\User::class)->create($user);
        echo "{$user["email"]} -> CREATED\n";
    }
}
