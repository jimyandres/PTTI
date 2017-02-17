<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('view-usuarios', function ($user) {
            return $user->tipoUsuario_codigoTipoUsuario === 0 || $user->tipoUsuario_codigoTipoUsuario === 1 || $user->tipoUsuario_codigoTipoUsuario === 2;
        });
        $gate->define('ingresar-usuarios', function ($user) {
            return $user->tipoUsuario_codigoTipoUsuario === 0 || $user->tipoUsuario_codigoTipoUsuario === 1;
        });
        $gate->define('modificar-usuarios', function ($user) {
            return $user->tipoUsuario_codigoTipoUsuario === 0 || $user->tipoUsuario_codigoTipoUsuario === 1;
        });
        $gate->define('eliminar-usuarios', function ($user) {
            return $user->tipoUsuario_codigoTipoUsuario === 0 || $user->tipoUsuario_codigoTipoUsuario === 1;
        });

        $gate->define('view-instituciones', function ($user) {
            return $user->tipoUsuario_codigoTipoUsuario === 1;
        });
        $gate->define('ingresar-instituciones', function ($user) {
            return $user->tipoUsuario_codigoTipoUsuario === 1;
        });
        $gate->define('modificar-instituciones', function ($user) {
            return $user->tipoUsuario_codigoTipoUsuario === 1;
        });
        $gate->define('eliminar-instituciones', function ($user) {
            return $user->tipoUsuario_codigoTipoUsuario === 1;
        });

        $gate->define('view-grupos', function ($user) {
            return $user->tipoUsuario_codigoTipoUsuario === 1 || $user->tipoUsuario_codigoTipoUsuario === 2;
        });
        $gate->define('ingresar-grupos', function ($user) {
            return $user->tipoUsuario_codigoTipoUsuario === 1;
        });
        $gate->define('modificar-grupos', function ($user) {
            return $user->tipoUsuario_codigoTipoUsuario === 1;
        });
        $gate->define('eliminar-grupos', function ($user) {
            return $user->tipoUsuario_codigoTipoUsuario === 1;
        });

        $gate->define('view-solicitudes', function ($user) {
            return $user->tipoUsuario_codigoTipoUsuario === 0 || $user->tipoUsuario_codigoTipoUsuario === 1;
        });
        $gate->define('aceptar-solicitudes', function ($user) {
            return $user->tipoUsuario_codigoTipoUsuario === 0 || $user->tipoUsuario_codigoTipoUsuario === 1;
        });
        $gate->define('rechazar-solicitudes', function ($user) {
            return $user->tipoUsuario_codigoTipoUsuario === 0 || $user->tipoUsuario_codigoTipoUsuario === 1;
        });

        $gate->define('view-test', function ($user) {
            return $user->tipoUsuario_codigoTipoUsuario === 1 || $user->tipoUsuario_codigoTipoUsuario === 2 || $user->tipoUsuario_codigoTipoUsuario === 3;
        });
        $gate->define('crear-test', function ($user) {
            return $user->tipoUsuario_codigoTipoUsuario === 1;
        });
        $gate->define('modificar-test', function ($user) {
            return $user->tipoUsuario_codigoTipoUsuario === 1;
        });
        $gate->define('eliminar-test', function ($user) {
            return $user->tipoUsuario_codigoTipoUsuario === 1;
        });

        $gate->define('asignar-test-usuarios', function ($user) {
            return $user->tipoUsuario_codigoTipoUsuario === 2;
        });

        $gate->define('cancelar-test', function ($user) {
            return $user->tipoUsuario_codigoTipoUsuario === 2;
        });

        $gate->define('realizar-test', function ($user) {
            return $user->tipoUsuario_codigoTipoUsuario === 3;
        });

        $gate->define('agregar-comentario', function ($user) {
            return $user->tipoUsuario_codigoTipoUsuario === 2;
        });
    }
}
