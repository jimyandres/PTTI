<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Institucion
 */
class Institucion extends Model
{
    protected $table = 'institucion';

    protected $primaryKey = 'codigoInstitucion';

	public $timestamps = false;

    protected $fillable = [
        'codigoInstitucion',
        'nombre',
        'direccion',
        'telefono',
        'sitioWeb',
        'ciudad'
    ];

    protected $guarded = [];

        
}