<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormularioUsuarioCampo extends Model
{
    use HasFactory;
    protected $table = 'formulario_usuario_campos';
    protected $fillable = ['formulario_usuario_id', 'campo_id', 'valor', 'observacao'];

    public function formularioUsuario(){
        return $this->belongsTo(FormularioUsuario::class, 'formulario_usuario_id', 'id');
    }

    public function campo(){
        return $this->belongsTo(Campo::class, 'campo_id', 'id');
    }
}
