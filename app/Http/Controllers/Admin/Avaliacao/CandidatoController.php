<?php

namespace App\Http\Controllers\Admin\Avaliacao;

use App\Http\Controllers\Controller;
use App\Models\FormularioUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CandidatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        dd($request->all());
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
        $formularioUsuario = FormularioUsuario::findOrFail($id);
        return view('pages.avaliacao.candidato.show', compact('formularioUsuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $formularioUsuario = FormularioUsuario::findOrFail($id);
        //VERIFICAR SE ESTÁ BLOQUEADO
        if (!$formularioUsuario->lock || (strtotime($formularioUsuario->lock) < strtotime('-15minutes')) || $formularioUsuario->user_id_is_assessing == Auth::id()) {
            $formularioUsuario->lock = Carbon::now();
            $formularioUsuario->user_id_is_assessing = Auth::id();
            $formularioUsuario->save();
            return view('pages.avaliacao.candidato.edit', compact('formularioUsuario'));
        }
        else return redirect()->back()->with(['type' => 'warning', 'msg' => 'O formulário está sendo avaliado por outro usuário, por favor, tente novamente mais tarde.']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
