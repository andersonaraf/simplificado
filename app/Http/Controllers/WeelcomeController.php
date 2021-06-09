<?php

namespace App\Http\Controllers;

use App\Models\Carrossel;
use App\Models\TipoTela;
use Illuminate\Http\Request;

class WeelcomeController extends Controller
{
    //

    public function index(){
        $recurso = \App\Models\TipoTela::where('nome_ou_anexo', 'Recurso')->first();
        $pdfs = TipoTela::where('tipo_tela_id', 2)->get();
        $inscricoes = TipoTela::where('tipo_tela_id', 3)->get();
        $protocolo = TipoTela::where('nome_ou_anexo', 'Protocolo')->first();
        $carrossels = Carrossel::all();


        return view('welcome', compact('recurso', 'pdfs', 'inscricoes', 'carrossels', 'protocolo'));
    }
}
