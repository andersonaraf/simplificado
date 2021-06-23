<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EditalDinamico extends Model
{
    //
    protected $table = 'edital_dinamicos';
    protected $fillable = [
        'telas_edital_id',
    ];

    public function escolaridadeEditalDinamico(){
        return $this->hasMany(EscolaridadeEditalDinamico::class, 'edital_dinamico_id', 'id');
    }

    public function progress(){
        return $this->hasMany(Progress::class, 'edital_dinamico_id', 'id');
    }

    public function telasEdital(){
        return $this->belongsTo(TelasEdital::class, 'telas_edital_id', 'id');
    }
}
