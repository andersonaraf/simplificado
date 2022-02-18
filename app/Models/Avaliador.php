<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avaliador extends Model
{
    use HasFactory;

    protected $table = 'avaliador';

    protected $fillable = [
        'avaliador',
        'candidato',
    ];

    public function cadidatos()
    {
        return $this->belongsTo(User::class, 'candidato', 'id');
    }
}
