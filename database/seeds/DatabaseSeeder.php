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
        $users = factory(App\User::class, 20)->create();
        
       $users->each(function(App\User $user) use ($users){


            //Times numero de objetos nuevos que creara
            factory(App\Message::class)->times(6)->create(['user_id'=>$user->id]);

            //Le hacemos seguir 10 usuarios al azar
            $user->follows()->sync($users->random(10));
        });
        
    }
}
