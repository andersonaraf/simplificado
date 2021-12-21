<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collapse extends Model
{
    use HasFactory;
    protected $table = 'collapses';
    protected $fillable = [
        'cargo_id',
        'nome',
    ];
}
