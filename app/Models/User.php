<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 */
class User extends Model
{
    protected $table = 'users';

    public $timestamps = true;

    protected $fillable = [
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