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
        'cargo'
    ];

    public function escolaridade(){
        return $this->hasOne(Escolaridade::class, 'id', 'escolaridade_id');
    }

    public function collapse(){
        return $this->hasMany(Collapse::class, 'cargo_id', 'id');
    }
}
