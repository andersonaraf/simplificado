<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCampo extends Model
{
    use HasFactory;

    protected $table = 'itens_campo';

    protected $fillable = [
        'campo_id',
        'item'
    ];
}
