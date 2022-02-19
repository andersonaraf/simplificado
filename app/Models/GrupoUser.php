<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class GrupoUser extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $table = 'grupo_users';
    protected $fillable = ['grupo_id', 'user_id'];

    public function grupo()
    {
        return $this->belongsTo('App\Models\Grupo');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
