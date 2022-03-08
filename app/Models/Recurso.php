<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;


class Recurso extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $table = 'recursos';
    protected $fillable = [
        'formulario_usuario_id',
        'aprovou_recurso',
        'status',
        'status_avaliacao',
        'motivo_recusar',
        'texto',
        'arquivo',
        'pontuacao',
    ];

    public function formularioUsuario(){
        return $this->belongsTo(FormularioUsuario::class, 'formulario_usuario_id', 'id');
    }

}
