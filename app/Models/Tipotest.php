<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipotest
 */
class Tipotest extends Model
{
    protected $table = 'tipotest';

    protected $primaryKey = 'codigoTipoTest';

	public $timestamps = false;

    protected $fillable = [
        'nombre'
    ];

    protected $guarded = [];

        
}