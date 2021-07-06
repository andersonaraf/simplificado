<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TelasEdital extends Model
{
    protected $table = 'telas_edital';
    protected $fillable = [
        'id',
        'tipo_tela_id',
        'nome_ou_anexo',
        'pontuacao_total',
        'status_liberar',
        'data_liberar',
        'data_fecha',
        'nome_anexo_mostrar'
    ];

    public function tipoTelas()
    {
        return $this->hasOne(TipoTelas::class, 'id', 'tipo_tela_id');
    }

    public function editalDinamico()
    {
        return $this->hasOne(EditalDinamico::class, 'telas_edital_id', 'id');
    }
}
