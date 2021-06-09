<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecursoModel extends Model
{
    //
    protected $table = 'recurso';
    protected $fillable = [
        'id',
        'pessoa_id',
        'avaliador_id',
        'status',
        'data_avaliado',
        'recurso',
        'recusar_motivo',
        'url_anexo',
    ];

    public function pessoa(){
        return $this->belongsTo(Pessoa::class, 'pessoa_id', 'id');
    }
}
