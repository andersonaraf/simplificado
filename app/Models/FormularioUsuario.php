<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormularioUsuario extends Model
{
    use HasFactory;
    protected $table = 'formulario_usuario';
    protected $fillabel = [
        'user_id',
        'formulario_id',
        'cargo_id'
    ];
}
