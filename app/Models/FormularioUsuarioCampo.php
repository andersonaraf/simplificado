<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormularioUsuarioCampo extends Model
{
    use HasFactory;
    protected $table = 'formulario_usuario_campos';
    protected $fillable = ['formulario_usuario_id', 'campo_id', 'valor', 'observacao'];
}
