<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Avaliador extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $table = 'avaliador';

    protected $fillable = [
        'avaliador',
        'formulario_usuario',
    ];

    public function formularioUsuario()
    {
        return $this->belongsTo(FormularioUsuario::class, 'formulario_usuario', 'id');
    }
}
