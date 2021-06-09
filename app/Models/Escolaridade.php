<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Escolaridade extends Model
{
    //
    protected $table = 'escolaridade';
    protected $fillable = [
        'id',
        'nivel_escolaridade',
    ];

    public function escolaridadeEditalDinamico($idEdital, $idEscolaridade)
    {
        $escolaridadeEditalDinamico = EscolaridadeEditalDinamico::where('edital_dinamico_id', $idEdital)->where('escolaridade_id', $idEscolaridade)->first();
        return $escolaridadeEditalDinamico;
    }
}
