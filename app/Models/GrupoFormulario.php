<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class GrupoFormulario extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $table = 'grupo_formularios';
    protected $fillable = ['grupo_id', 'formulario_id'];

    public function formulario()
    {
        return $this->belongsTo('App\Models\Formulario');
    }

    public function grupo()
    {
        return $this->belongsTo('App\Models\Grupo');
    }
}
