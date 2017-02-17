<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipousuario
 */
class Tipousuario extends Model
{
    protected $table = 'tipousuario';

    protected $primaryKey = 'codigoTipoUsuario';

	public $timestamps = false;

    protected $fillable = [
        'nombre'
    ];

    protected $guarded = [];

        
}