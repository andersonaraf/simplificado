<?php

namespace App\Http\Controllers\Admin\Avaliacao;

use App\Http\Controllers\Controller;
use App\Models\Avaliador;
use App\Models\Formulario;
use App\Models\FormularioUsuario;
use App\Models\GrupoUser;
use Illuminate\Support\Facades\Auth;

class FormularioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupoUsers = GrupoUser::where('user_id', Auth::user()->id)->get();
        return view('pages.avaliacao.index', compact('grupoUsers'));
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
        $formulario = Formulario::findOrFail($id);
        $avaliador = $formulario->formularioUsuarioAvaliador;
        return view('pages.avaliacao.show', compact('formulario','avaliador'));
    }
}
