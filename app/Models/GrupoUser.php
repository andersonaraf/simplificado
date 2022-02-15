<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoUser extends Model
{
    use HasFactory;
    protected $table = 'grupo_users';
    protected $fillable = ['grupo_id', 'user_id'];

    public function grupo()
    {
        return $this->belongsTo('App\Models\Grupo');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
