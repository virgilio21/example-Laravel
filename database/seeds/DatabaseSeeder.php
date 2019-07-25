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
        
        //Usamos un factory para crear usuarios por cada cinco usuarios tienen cada uno 4 mensajes
        factory(App\User::class, 5)->create()->each(function(App\User $user){


            //Times numero de objetos nuevos que creara
            factory(App\Message::class)->times(4)->create(['user_id'=>$user->id]);

        });
        
    }
}
