<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    //
    public static function store($data){

        return Endereco::create($data)->id;
    }
}
