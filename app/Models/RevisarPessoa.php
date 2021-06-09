<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class RevisarPessoa extends Model
{
    //
    protected $table = 'revisar_pessoas';
    protected $fillable = [
        'pessoa_id',
        'revisor_id',
        'motivo',
    ];

    public function pessoa(){
        return $this->belongsTo(Pessoa::class, 'pessoa_id', 'id');
    }

    public function revisor(){
        return $this->belongsTo(User::class, 'revisor_id', 'id');
    }
}
