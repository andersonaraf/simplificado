<?php

namespace App\Models;

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
        'bloquear',
    ];

    public function escolaridade(){
        return $this->hasOne(Escolaridade::class, 'id', 'escolaridade_id');
    }

    public function collapse(){
        return $this->hasMany(Collapse::class, 'cargo_id', 'id');
    }

    public function formularioUsuario(){
        return $this->hasMany(FormularioUsuario::class, 'cargo_id', 'id')->with('user', function ($query){
            $query->with('pessoa', function ($query){
               //ORDENAR POR DATA DE NASCIMENTO
                $query->orderBy('data_nascimento', 'desc')->get();
            });
        });
    }
}
