<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Formulario extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $table = 'formularios';
    protected $fillable = [
        'nome',
        'pontuacao',
        'liberado',
        'data_liberar',
        'data_fecha',
    ];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::deleting(function ($formulario) {
            $formulario->escolaridade()->delete();
        });
    }

    public function escolaridades()
    {
        return $this->hasMany(Escolaridade::class, 'formulario_id', 'id');
    }

    public function formularioUsuario()
    {
        return $this->hasMany(FormularioUsuario::class, 'formulario_id', 'id');
    }

    public function grupoFormulario()
    {
        return $this->hasMany(GrupoFormulario::class, 'formulario_id', 'id');
    }
}
