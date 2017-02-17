<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Preguntastest
 */
class Preguntastest extends Model
{
    protected $table = 'preguntastest';

    protected $primaryKey = 'codigoPregunta';

	public $timestamps = false;

    protected $fillable = [
        'enunciado',
        'opcionesRespuesta'
    ];

    protected $guarded = [];

        
}