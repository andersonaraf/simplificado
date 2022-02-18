<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PontuacaoCampo extends Model
{
    use HasFactory;
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
