<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoDinamico extends Model
{

    protected $table = 'documento_dinamicos';

    protected $fillable = [
        'edital_dinamico_tipo_anexo_id',
        'nome_documento',
        'pontuacao_maxima',
        'pontuacao_maxima_item',
        'pontuacao_por_item',
        'quantidade_anexos',
        'obrigatorio',
        'quantidade_maxima_ano',
        'pontuacao_por_ano',
        'pontuacao_por_mes',
        'tipo_experiencia',
        'pontuacao_manual',
        'especial',
    ];

    public function editalDinamicoTipoAnexo()
    {
        return $this->belongsTo(EditalDinamicoTipoAnexo::class, 'edital_dinamico_tipo_anexo_id', 'id');
    }
}
