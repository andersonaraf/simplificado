<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoAnexo extends Model
{
    //
    protected $table = 'tipo_anexo';
    protected $fillable = [
        'tipo'
    ];

    public function pessoaEditalAnexosPessoa($pessoaID, $editalDinamicoID, $tipoAnexoID){
        return PessoaEditalAnexo::where('edital_dinamico_id', $editalDinamicoID)->where('tipo_anexo_id', $tipoAnexoID)->where('pessoa_id', $pessoaID)->get();
    }
}
