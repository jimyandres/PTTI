<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Informe
 */
class Informe extends Model
{
    protected $table = 'informe';

    protected $primaryKey = 'codigoInforme';

	public $timestamps = false;

    protected $fillable = [
        'graficas',
        'cantidadTest',
        'finalizados',
        'descripcion',
        'pendientes',
        'realizados',
        'fecha'
    ];

    protected $guarded = [];

        
}