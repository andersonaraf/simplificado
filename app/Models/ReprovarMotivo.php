<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReprovarMotivo extends Model
{
    use HasFactory;
    protected $table = 'reprovar_motivos';
    protected $fillable = [
        'user_id',
        'formulario_usuario_id',
        'motivo',
    ];

    public function formularioUsuario()
    {
        return $this->belongsTo(FormularioUsuario::class, 'formulario_usuario_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
