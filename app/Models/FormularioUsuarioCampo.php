<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class FormularioUsuarioCampo extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $table = 'formulario_usuario_campos';
    protected $fillable = ['formulario_usuario_id', 'campo_id', 'valor', 'observacao'];

    public function formularioUsuario()
    {
        return $this->belongsTo(FormularioUsuario::class, 'formulario_usuario_id', 'id');
    }

    public function campo()
    {
        return $this->belongsTo(Campo::class, 'campo_id', 'id');
    }

    public function pontuacaoCampoLast(){
        return $this->hasOne(PontuacaoCampo::class, 'formulario_usuario_campos_id', 'id')->latest();
    }
}
