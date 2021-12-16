<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Genero extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $table = 'generos';
    protected $fillable = [
        'name',
    ];

    public function pessoa(){
        return $this->hasMany(Pessoa::class, 'genero_id', 'id');
    }
}
