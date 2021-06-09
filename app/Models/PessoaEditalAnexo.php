<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PessoaEditalAnexo extends Model
{
    //
    protected $table = 'pessoa_edital_anexos';

    protected $fillable = [
        'edital_dinamico_id',
        'tipo_anexo_id',
        'pessoa_id',
        'documento_dinamico_id',
        'nome_arquivo',
        'pontuacao',
        'pontuacao_exp_publico',
        'pontuacao_exp_privado'
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'pessoa_id', 'id');
    }

    public function tipoAnexo()
    {
        return $this->belongsTo(TipoAnexo::class, 'tipo_anexo_id', 'id');
    }

    public function editalDinamico()
    {
        return $this->belongsTo(EditalDinamico::class, 'edital_dinamico_id', 'id');
    }

    public function documentoDinamico()
    {
        return $this->belongsTo(DocumentoDinamico::class, 'documento_dinamico_id', 'id');
    }
}
