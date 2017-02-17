<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * Class Usuario
 */
class Solicitude extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{

    use Authenticatable, Authorizable, CanResetPassword;

    protected $table = 'solicitudes';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'nombre',
        'apellido',
        'email',
        'tipoDocumento',
        'fechaNacimiento',
        'activo',
        'password',
        'remember_token',
        'genero',
        'telefono',
        'grupo_codigoGrupo',
        'institucion_codigoInstitucion',
        'tipoUsuario_codigoTipoUsuario'
    ];

    protected $guarded = [];


}