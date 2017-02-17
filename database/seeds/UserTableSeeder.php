<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create([
            'nombre' => 'root',
            'email' => 'root@ptti.com',
            'password' => bcrypt('root'),
            'active' => 1,
            'tipoUsuario_codigoTipoUsuario' => 0
        ]);
        factory(\App\User::class)->create([
            'nombre' => 'Luis David',
            'email' => 'david-0296@hotmail.com',
            'password' => bcrypt('admin'),
            'active' => 1,
            'tipoUsuario_codigoTipoUsuario' => 1
        ]);
        factory(\App\User::class)->create([
            'nombre' => 'Felipe',
            'email' => 'pipe.0325@hotmail.com',
            'password' => bcrypt('chimuelo'),
            'active' => 1,
            'tipoUsuario_codigoTipoUsuario' => 3
        ]);
        factory(\App\User::class)->create([
            'nombre' => 'Valentina',
            'apellido' => 'Franco',
            'email' => 'valenfranco@hotmail.com',
            'password' => bcrypt('psicologo'),
            'active' => 1,
            'tipoUsuario_codigoTipoUsuario' => 2
        ]);
        factory(\App\User::class, 49)->create();
    }
}
