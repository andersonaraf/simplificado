<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Models\Pontuacao;
use App\Models\Recurso;
use App\Models\RecursoModel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('acesso.restrito');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $pessoa = Pessoa::all()->count();
        $pontuacao = 0;
        $recurso = Recurso::all()->count();

        return view('dashboard', [
            'inscricao_total' => $pessoa,
            'avaliacao_total' => $pontuacao,
            'recurso_total' => $recurso,
        ]);
    }
}
