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
        $user = [ "email" => "admin@test.com" ];
        factory(App\User::class)->create($user);
        echo "USER-TEST: {$user["email"]} PASSWORD-TEST: secret";
    }
}
