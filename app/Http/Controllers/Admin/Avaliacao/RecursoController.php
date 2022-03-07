<?php

namespace App\Http\Controllers\Admin\Avaliacao;

use App\Http\Controllers\Controller;
use App\Models\Recurso;
use Illuminate\Http\Request;

class RecursoController extends Controller
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $recurso = Recurso::findOrFail($request->idRecurso);
        //VERIFICAR SE PERTENCE AO FORMULÁRIO DO AVALIADOR
        //VERIFICAR SE O RECURSO JÁ VOI AVALIADO
        if (!is_null($recurso->status)) return response()->json(['type' => 'error', 'msg' => 'Recurso já avaliado.'], 401);
        //VERIFICAR SE O RECURSO UTRAPASSOU A PONTUACAO MÁXIMA
        if ($request->recursoPontuacao > ($recurso->formularioUsuario->formulario->pontuacao - $recurso->formularioUsuario->pontuacao_total))
            return response()->json(['type' => 'error', 'msg' => 'Pontuação excede a pontuação máxima de ' . $recurso->formularioUsuario->formulario->pontuacao . '.'], 401);
        //RECUSAR RECURSO
        if ($request->tipoRecurso == 0) {
            try {
                $recurso->motivo_recusar = $request->motivoRecusar;
                $recurso->status = 0;
                $recurso->aprovou_recurso = auth()->user()->id;
                $recurso->status_avaliacao = 0;
                $recurso->pontuacao = 0.0;
                $recurso->save();
                //DEVOLVER UM JSON
                return response()->json(['type' => 'success', 'msg' => 'Recurso recusado com sucesso!']);
            } catch (\Exception $exception) {
                return response()->json(['type' => 'error', 'msg' => 'Erro ao recusar recurso!'], 500);
            }
        } else if($request->tipoRecurso == 1) {
            $recurso->status = 1;
            $recurso->aprovou_recurso = auth()->user()->id;
            $recurso->status_avaliacao = 1;
            $recurso->pontuacao = !is_null($request->recursoPontuacao) ? (float)$request->recursoPontuacao : 0.0;
            $recurso->save();
            return response()->json(['type' => 'success', 'msg' => 'Recurso válidado com sucesso!']);
        } else {
            return response()->json(['type' => 'error', 'msg' => 'Tipo de recurso inválido!'], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $recurso = Recurso::findOrFail($id);
        $formulariUsuario = $recurso->formularioUsuario;
        //BLOQUEAR POR 15 MINUTOS O ACESSO AO FORMULÁRIO
        return view('pages.avaliacao.recurso.show', compact('recurso', 'formulariUsuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //PONTUAR RECURSO

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
