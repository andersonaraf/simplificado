<?php

namespace App\Http\Controllers\Admin\Avaliacao;

use App\Http\Controllers\Controller;
use App\Models\FormularioUsuario;
use App\Models\ReprovarMotivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReprovarController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $formularioUsuario = FormularioUsuario::findOrFail($request->formularioUsuarioID);
        //VERIFICAR SE JÁ FOI AVALIADO
        if (!is_null($formularioUsuario->avaliado)) return response()->json(['error' => 'Avaliação já foi realizada'], 400);
        //VERIFICAR SE O MOTIVO EXISTE
        if (!isset($request->motivo)) {
            //VERIFICAR SE É VAZIO OU NULO
            if (empty($request->motivo) || is_null($request->motivo)) return response()->json(['error' => 'Motivo deve ser informado!'], 400);
        }

        try {
            DB::beginTransaction();
            $formularioUsuario->avaliado = 0;
            $formularioUsuario->save();
            //SALVAR O MOTIVO DA REPROVAÇÃO
            $reprovar = new ReprovarMotivo();
            $reprovar->formulario_usuario_id = $formularioUsuario->id;
            $reprovar->motivo = $request->motivo;
            $reprovar->user_id = auth()->user()->id;
            $reprovar->save();
            DB::commit();
            return response()->json(['success' => 'Formulário reprovado com sucesso.'], 200);
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return response()->json(['error' => 'Erro ao reprovar avaliação'], 500);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        //
    }
}
