<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    //
    protected $table = 'endereco';
    protected $fillable = [
        'id',
        'endereco',
        'bairro',
        'cep',
    ];
}
