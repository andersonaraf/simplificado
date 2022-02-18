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
        $formulariUsuario = FormularioUsuario::findOrFail($id);
        return view('pages.avaliacao.candidato.show', compact('formulariUsuario'));
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
        $formulariUsuario = FormularioUsuario::findOrFail($id);
        //VERIFICAR SE ESTÁ BLOQUEADO
        if (!$formulariUsuario->lock || (strtotime($formulariUsuario->lock) < strtotime('-15minutes')) || $formulariUsuario->user_id_is_assessing == Auth::id()) {
            $formulariUsuario->lock = Carbon::now();
            $formulariUsuario->user_id_is_assessing = Auth::id();
            $formulariUsuario->save();
            return view('pages.avaliacao.candidato.edit', compact('formulariUsuario'));
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
