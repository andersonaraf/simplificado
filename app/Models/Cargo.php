<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Cargo extends Model implements Auditable
{
    //
    use AuditableTrait;

    protected $table = 'cargos';
    protected $fillable = [
        'id',
        'escolaridade_id',
        'cargo',
        'informativo',
        'bloquear',
    ];

    public function escolaridade()
    {
        return $this->hasOne(Escolaridade::class, 'id', 'escolaridade_id');
    }

    public function collapse()
    {
        return $this->hasMany(Collapse::class, 'cargo_id', 'id');
    }

    public function formularioUsuario()
    {
        $x = $this->hasMany(FormularioUsuario::class, 'cargo_id', 'id');
        if (isset($this->tipoAprovacao)) {
            if ($this->tipoAprovacao != "TODOS" && $this->tipoAprovacao != "EM ANALISE") $x->where(['avaliado' => $this->tipoAprovacao, 'revisado' => $this->tipoAprovacao]);
            else if ($this->tipoAprovacao == "EM ANALISE") $x->whereNull(['avaliado', 'revisado']);
        }

        $x->whereHas('user', function ($query) {
            $query->whereHas('pessoa', function ($query) {
                if (isset($this->pne)) {
                    if ($this->pne == 1 || $this->pne == 0) $query->where('portador_deficiencia', $this->pne);
                }
                if(isset($this->nomeParticipante))
                    if(!is_null($this->nomeParticipante)) $query->where('nome_completo', 'like', '%'.$this->nomeParticipante.'%');
                $query->orderBy('data_nascimento', 'desc');
            });
        })->orderBy('pontuacao_total', 'desc')->get();
        return $x;
    }
}
