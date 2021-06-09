<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EditalDinamico extends Model
{
    //
    protected $table = 'edital_dinamicos';
    protected $fillable = [
        'tipo_tela_id',
    ];

    public function escolaridadeEditalDinamico(){
        return $this->hasMany(EscolaridadeEditalDinamico::class, 'edital_dinamico_id', 'id');
    }

    public function progress(){
        return $this->hasMany(Progress::class, 'edital_dinamico_id', 'id');
    }

    public function tipoTela(){
        return $this->belongsTo(TipoTela::class, 'tipo_tela_id', 'id');
    }
}
