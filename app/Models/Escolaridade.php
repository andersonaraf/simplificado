<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Escolaridade extends Model implements Auditable
{
    //
    use AuditableTrait;
    protected $table = 'escolaridade';
    protected $fillable = [
        'id',
        'formulario_id',
        'nivel_escolaridade',
        'bloquear',
    ];

    public function cargos(){
        return $this->hasMany(Cargo::class, 'escolaridade_id', 'id');
    }

    public function formulario(){
        return $this->belongsTo(Formulario::class, 'formulario_id', 'id');
    }
}
