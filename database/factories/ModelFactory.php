<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use App\Models\Grupo;

$factory->define(\App\User::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->regexify('^\d{10,11}$'),
        'nombre' => $faker->firstName,
        'apellido' => $faker->lastName,
        'email' => $faker->safeEmail,
        'tipoDocumento' => $faker->randomElement(['CC','TI']),
        'fechaNacimiento' => $faker->date(),
        'active' => random_int(0,1),
        'password' => bcrypt(str_random(10)),
        'remember_token' => null,
        'genero' => $faker->randomElement(['Masculino', 'Femenino']),
        'telefono' => $faker->e164PhoneNumber,
        'grupo_codigoGrupo' => null,
        'institucion_codigoInstitucion' => null,
        'tipoUsuario_codigoTipoUsuario' => $faker->randomElement([1, 2, 3])

    ];
});
