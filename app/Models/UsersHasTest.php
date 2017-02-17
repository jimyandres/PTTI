<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UsersHasTest
 */
class UsersHasTest extends Model
{
    //use Traits\HasCompositePrimaryKey;

    protected $table = 'users_has_test';

    public $timestamps = false;

    protected $fillable = [
        'users_id',
        'users_tipoUsuario_codigoTipoUsuario',
        'test_codigoTest',
        'test_tipoTest_codigoTipoTest',
        'estadoTest',
        'resultado',
        'diagnostico',
    ];

    //protected $primaryKey = array('users_id', 'test_codigoTest');

    protected $guarded = [];

    protected function setKeysForSaveQuery(Builder $query)
    {
        $query
            //Put appropriate values for your keys here:
            ->where('users_id', '=', $this->users_id)
            ->where('test_codigoTest', '=', $this->test_codigoTest);

        return $query;
    }

        
}