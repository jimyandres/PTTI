<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Respuesta
 */
class Respuesta extends Model
{
    protected $table = 'respuestas';

    protected $primaryKey = 'idRespuestas';

	public $timestamps = false;

    protected $fillable = [
        'preguntasTest_codigoPregunta',
        'users_id',
        'users_tipoUsuario_codigoTipoUsuario',
        'respuesta'
    ];

    protected $guarded = [];

        
}