<?php

namespace App\Http\Controllers\ListaCandidatos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListaController extends Controller
{
    //
    public function index (Collection $pessoas) {
        return view('pages.lista-candidatos.index', compact('pessoas'));
    }
}
