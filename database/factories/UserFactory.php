<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});


//Crear este factory nos permite luego agregar datos a la base de datos de manera aletoria para ingresar datos a la base de datos y ver como se comporta.
//Necesitamos hacer algo mas en un archivo llamado /database/seeds/databaseSeeder.php.
$factory->define(App\Message::class, function(Faker $faker){

    //Dentro de realText determinamos el largo de la cadena, que se contruye con partes del libro alicia en el pais de las maravillas
    return [
        'content'=>$faker->realText(random_int(20,160)),
        'image'=>$faker->imageUrl(600,388),
    ];
});
