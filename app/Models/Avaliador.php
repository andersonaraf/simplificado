<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avaliador extends Model
{
    use HasFactory;

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
