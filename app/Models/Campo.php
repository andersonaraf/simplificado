<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Campo extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

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

    public function intemCampo()
    {
        return $this->hasMany(ItemCampo::class, 'campo_id', 'id');
    }
}
