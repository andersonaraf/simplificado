<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Carrossel extends Model implements Auditable
{
    //
    use AuditableTrait;
    protected $table = 'carrossel';
    protected $fillable = [
        'url_img',
        'url_link',
    ];
}
