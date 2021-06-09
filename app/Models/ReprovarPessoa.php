<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ReprovarPessoa extends Model
{
    //
    protected $table = 'reprovar_pessoas';
    protected $fillable = [
        'pessoa_id',
        'avaliador_id',
        'motivo',
    ];

    public function pessoa(){
        return $this->belongsTo(Pessoa::class, 'pessoa_id', 'id');
    }

    public function avaliador(){
        return $this->belongsTo(User::class, 'avaliador_id', 'id');
    }
}
