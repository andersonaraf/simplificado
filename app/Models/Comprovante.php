<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comprovante extends Model
{
    //
    //
    protected $table = 'comprovante';
    protected $fillable = [
        'id',
        'comprovante',
    ];

    public function pessoa(){
        return $this->hasOne(Pessoa::class, 'comprovante_id', 'id');
    }
}
