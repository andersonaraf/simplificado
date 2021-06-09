<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Termos extends Model
{
    //
    protected $table = 'termos';
    protected $fillable = [
        'id',
        'pessoa_id',
        'aceito_dados'
    ];

    public function pessoa(){
        return $this->hasOne(Pessoa::class, 'id', 'pessoa_id');
    }
}
