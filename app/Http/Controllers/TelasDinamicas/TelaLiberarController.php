<?php

namespace App\Http\Controllers\TelasDinamicas;

use App\Http\Controllers\Controller;
use App\Models\TipoTela;
use Illuminate\Http\Request;

class TelaLiberarController extends Controller
{
    //
    public function index(){
        return view('pages.telas-dinamicas.liberar-tela', [
           'tipos_telas' => TipoTela::paginate(15),
        ]);
    }
}
