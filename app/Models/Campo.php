<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campo extends Model
{
    use HasFactory;
    protected $table = 'campos';
    protected $fillable = [
        'collapse_id',
        'atributo_id',
        'tipo_campo_id',
        'nome',
        'pontuar',
        'ponto',
    ];
}
