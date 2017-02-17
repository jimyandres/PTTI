<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Grupo
 */
class Grupo extends Model
{
    protected $table = 'grupo';

    protected $primaryKey = 'codigoGrupo';

	public $timestamps = false;

    protected $fillable = [
        'codigoGrupo',
        'clasificacion',
        'jornada',
        'grado',
        'institucion_codigoInstitucion'
    ];

    protected $guarded = [];

    public static function grupos($codigoInstitucion)
    {
        return Grupo::where('institucion_codigoInstitucion', '=', $codigoInstitucion)
            ->get();
    }
}