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
        // $this->call(UsersTableSeeder::class);
        //se usa factory como funcion
        //Times numero de objetos nuevos que creara
        factory(App\Message::class)->times(4)->create();
    }
}
