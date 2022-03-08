<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editais extends Model
{
    use HasFactory;
    protected $table = 'editais';
    protected $fillable = [
        'formulario_id',
        'titulo',
        'documento',
        'descricao',
        'hierarquia',
    ];

    public function formulario(){
        return $this->belongsTo(Formulario::class, 'formulario_id', 'id');
    }
}
