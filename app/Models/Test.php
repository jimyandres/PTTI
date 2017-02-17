<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Test
 */
class Test extends Model
{
    protected $table = 'test';

    public $timestamps = false;

    protected $fillable = [
        'codigoTest',
        'descripcion',
        'tipoTest_codigoTipoTest',
        'informe_codigoInforme'
    ];

    protected $primaryKey = 'codigoTest';

    protected $guarded = [];

        
}