<?php

namespace App\Http\Controllers\Admin\Avaliacao;

use App\Http\Controllers\Controller;
use App\Models\FormularioUsuario;
use App\Models\FormularioUsuarioCampo;
use App\Models\PontuacaoCampo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PontuacaoController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $formularioUsuario = FormularioUsuario::findOrFail($request->formularioUsuarioID);
        //VALIDAR CAMPOS
        $valido = $this->validarCampos($request->pontuacoes);
        if ($valido != true) return response()->json(['error' => 'Campos inválidos. A pontuação passou do limite do campo ou está negativa!', 'campo' => $valido], 422);
        //REALIZAR PONTUACAO
        $pontuacao = $this->salvarPontuacao($request->pontuacoes);
        if (!$pontuacao) return response()->json(['error' => 'Erro ao salvar pontuação'], 422);
        //ALTERAR A COLUNA AVALIADO PARA TRUE
        $formularioUsuario->avaliado = true;
        $formularioUsuario->save();
        //ENVIAR MSG DE SUCESSO
        return response()->json(['msg' => 'Avaliação salva com sucesso!'], 200);
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

    public function validarCampos($pontuacoes){
        foreach ($pontuacoes as $pontuacao){
            $formularioUsuarioCampo = FormularioUsuarioCampo::findOrFail($pontuacao['usuarioCampoID']);
            $campo = $formularioUsuarioCampo->campo;
            //VERIFICAR SE A PONTUACAO APLICADA AO CAMPO PASSOU DA PONTUACAO MAXIMA
            if($pontuacao['pontuacao'] > $campo->ponto){
                return $campo;
            }
            //VERIFICAR SE A PONTUACAO E NEGATIVA
            if($pontuacao['pontuacao'] < 0){
                return $campo;
            }
        }
        return true;
    }

    public function salvarPontuacao($pontuacoes){
        try {
            DB::beginTransaction();
            foreach ($pontuacoes as $pontuacao) {
                $formularioUsuarioCampo = FormularioUsuarioCampo::findOrFail($pontuacao['usuarioCampoID']);
                $pontuacaoCampo = new PontuacaoCampo();
                $pontuacaoCampo->formulario_usuario_campos_id = $formularioUsuarioCampo->id;
                $pontuacaoCampo->user_id = Auth::id();
                $pontuacaoCampo->pontuacao = $pontuacao['pontuacao'];
                $pontuacaoCampo->save();
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
}
