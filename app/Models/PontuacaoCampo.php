<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class PontuacaoCampo extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $table = 'pontuacao_campos';
    protected $fillable = [
        'formulario_usuario_campos_id',
        'user_id',
        'pontuacao',
    ];

    public function formularioUsuarioCampo()
    {
        return $this->belongsTo(FormularioUsuarioCampo::class, 'formulario_usuario_campos_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
