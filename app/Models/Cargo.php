<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    //
    protected $table = 'cargos';
    protected $fillable = [
        'id',
        'escolaridade_id',
        'escolaridade_edital_dinamico_id',
        'cargo'
    ];

    public function escolaridade(){
        return $this->hasOne(Escolaridade::class, 'id', 'escolaridade_id');
    }

    public function tipoAnexo(){
        return $this->hasMany(TipoAnexo::class, 'cargo_id', 'id');
    }

    public function escolaridadeEditalDinamico(){
        return $this->belongsTo(EscolaridadeEditalDinamico::class, 'escolaridade_edital_dinamico_id', 'id');
    }
}
