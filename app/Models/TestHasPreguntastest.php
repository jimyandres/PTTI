<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TestHasPreguntastest
 */
class TestHasPreguntastest extends Model
{
    //use Traits\HasCompositePrimaryKey;

    protected $table = 'test_has_preguntastest';

    public $timestamps = false;

    protected $fillable = [
        'test_codigoTest',
        'test_tipoTest_codigoTipoTest',
        'preguntasTest_codigoPregunta'
    ];

    //protected $primaryKey = array('preguntasTest_codigoPregunta', 'test_codigoTest');

    protected $guarded = [];

    /**
     * Set the keys for a save update query.
     * This is a fix for tables with composite keys
     * TODO: Investigate this later on
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery(Builder $query)
    {
        $query
            //Put appropriate values for your keys here:
            ->where('preguntasTest_codigoPregunta', '=', $this->preguntasTest_codigoPregunta)
            ->where('test_codigoTest', '=', $this->test_codigoTest);

        return $query;
    }

        
}