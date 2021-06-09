<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anexos extends Model
{
    //
    protected $table = 'anexo';
    protected $fillable = [
        'anexo_escolaridade',
        'documento_pessoas',
        'anexo_deficiencia',
        'extra',
    ];

    public function anexoCursoTecnico(){
        return $this->hasMany(AnexoCursoTecnico::class, 'anexo_id', 'id');
    }

    public function anexoEspecializacao(){
        return $this->hasMany(AnexoEspecializacao::class, 'anexo_id', 'id');
    }

    public function anexoMestrado(){
        return $this->hasMany(AnexoMestrado::class, 'anexo_id', 'id');
    }

    public function anexoDoutorado(){
        return $this->hasMany(AnexoDoutorado::class, 'anexo_id', 'id');
    }

    public function anexoExperiencia(){
        return $this->hasMany(AnexoExperiencia::class, 'anexo_id', 'id');
    }
}
