<?php

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
        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            $data = \Illuminate\Support\Facades\Config::get('fake-data');
            foreach ($data["people"] as $person ) {
                $auxUser = ["email" => $person["email"]];
                $user = factory(App\User::class)->create($auxUser);

                $auxPerson = [  "name"        => $person["name"],
                                "last_name"   => $person["last_name"],
                                "user_id"     => $user->id
                ];

                $person_db = factory(App\Person::class)->create($auxPerson);

                foreach ($person["locations"] as $location ) {
                    $location["person_id"] = $person_db->id;
                    $location_db = factory(App\Location::class)->create($location);
                }
            }
            \Illuminate\Support\Facades\DB::commit();
        } catch(Exception $e ) {
            echo "error:" . $e->getMessage() . "-File:".  $e->getFile(). "- Line:" . $e->getLine();
            \Illuminate\Support\Facades\DB::rollBack();
        }
    }
}
