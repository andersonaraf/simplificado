<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    use HasFactory;
    protected $table = 'recursos';
    protected $fillable = [
        'formulario_usuario_id',
        'aprovou_recurso',
        'texto',
        'arquivo',
        'pontuacao',
    ];

    public function formularioUsuario(){
        return $this->belongsTo(FormularioUsuario::class, 'formulario_usuario_id', 'id');
    }

}
