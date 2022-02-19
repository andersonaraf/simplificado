<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class TipoCampo extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $table = 'tipo_campos';
    protected $fillable = [
        'tipo',
    ];
}
