<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormularioUsuario extends Model
{
    use HasFactory;
    protected $table = 'formulario_usuario';
    protected $fillabel = [
        'user_id',
        'formulario_id',
        'cargo_id',
        'user_id_is_assessing',
        'lock'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id', 'id');
    }

    public function formulario(){
        return $this->belongsTo(Formulario::class, 'formulario_id', 'id');
    }

    public function formularioUsuarioCampo(){
        return $this->hasMany(FormularioUsuarioCampo::class, 'formulario_usuario_id', 'id');
    }

    public function userIsAssessing()
    {
        return $this->belongsTo(User::class, 'user_id_is_assessing', 'id');
    }
}
