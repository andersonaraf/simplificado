<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumeroContato extends Model
{
    use HasFactory;
    protected $table = 'numero_contatos';
    protected $fillable = [
        'pessoa_id',
        'numero',
    ];
}
