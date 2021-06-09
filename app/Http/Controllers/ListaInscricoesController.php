<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\TipoAnexo;
use App\Models\TipoTela;
use Illuminate\Http\Request;

class ListaInscricoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $listaFormularios = TipoTela::where('tipo_tela_id', 3)->get();

        return view('pages.lista-inscricoes.lista', compact('listaFormularios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
//        dd($id);
        $tela = TipoTela::findOrFail($id);
        $cargos = Cargo::all();


        return view('pages.lista-inscricoes.editar', compact('tela', 'cargos'));
    }

   public function search(Request $request){
//        dd($request->all());
       $tela = TipoTela::findOrFail($request->tela_id);
       $cargos = Cargo::all();
       $cargo = Cargo::findOrFail($request->cargo);
       return view('pages.lista-inscricoes.editar', compact('tela', 'cargos', 'cargo'));
   }
}
