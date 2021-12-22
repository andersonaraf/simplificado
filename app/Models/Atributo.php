<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atributo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'attr_id',
        'placeholder',
        'value',
        'title',
        'max',
        'min',
        'steep',
        'required',
        'selected',
    ];
}
