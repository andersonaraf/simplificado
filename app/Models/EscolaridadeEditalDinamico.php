<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EscolaridadeEditalDinamico extends Model
{
    //
    protected $table = 'escolaridade_edital_dinamicos';
    protected $fillable = [
        'edital_dinamico_id',
        'escolaridade_id'
    ];

    public function escolaridade(){
        return $this->hasOne(Escolaridade::class, 'id', 'escolaridade_id');
    }

    public function editalDinamico(){
        return $this->hasOne(EditalDinamico::class, 'id', 'edital_dinamico_id');
    }

    public function cargos(){
        return $this->hasMany(Cargo::class, 'escolaridade_edital_dinamico_id', 'id');
    }
}
