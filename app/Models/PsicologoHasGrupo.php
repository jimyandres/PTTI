<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PsicologoHasGrupo
 */
class PsicologoHasGrupo extends Model
{
    protected $table = 'psicologo_has_grupo';

    protected $primaryKey = 'grupo_codigoGrupo';

    public $timestamps = false;

    protected $fillable = [
        'users_id',
        'users_tipoUsuario_codigoTipoUsuario',
        'grupo_codigoGrupo'
    ];

    protected $guarded = [];

        
}