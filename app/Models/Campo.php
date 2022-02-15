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

    public function tipoCampo()
    {
        return $this->belongsTo(TipoCampo::class, 'tipo_campo_id', 'id');
    }

    public function atributos()
    {
        return $this->belongsTo(Atributo::class, 'atributo_id', 'id');
    }
}
