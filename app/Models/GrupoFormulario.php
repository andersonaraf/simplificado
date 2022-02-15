<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoFormulario extends Model
{
    use HasFactory;
    protected $table = 'grupo_formularios';
    protected $fillable = ['grupo_id', 'formulario_id'];

    public function formulario()
    {
        return $this->belongsTo('App\Models\Formulario');
    }

    public function grupo()
    {
        return $this->belongsTo('App\Models\Grupo');
    }
}
