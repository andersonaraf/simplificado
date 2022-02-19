<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Grupo extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $table = 'grupos';
    protected $fillable = ['nome'];


    public function grupoUsers()
    {
        return $this->hasMany(GrupoUser::class);
    }

    public function grupoFormularios()
    {
        return $this->hasMany(GrupoFormulario::class);
    }

}
