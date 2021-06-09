<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Models\PessoaEditalAnexo;
use App\Models\Pontuacao;
use App\Models\ReprovarPessoa;
use App\Models\Transparencia;
use App\Models\DocumentoDinamico;
use Illuminate\Http\Request;

class AvaliadorAvaliarController extends Controller
{

    public function aprovar(Request $request)
    {

        $anexo = $request->anexo;
        $pontuacao_verificar = 0;
        $pontuacao_maxima = $request->pontuacao_maxima;
        $pontuacao_manual = $request->pontuacao_manual;
        $pontuacao_por_ano = $request->pontuacao_por_ano;
        $pontuacao_por_mes = $request->pontuacao_por_mes;
        $pessoa = Pessoa::findOrFail($request->pessoa_id);
        $url = str_replace("Novo/", "", $_SERVER["REQUEST_URI"]);
        $pontuacaoTotal = 0;
        $pontuacaoTotalPublica2 = 0;
        $pontuacaoTotalPrivada2 = 0;
        if ($pontuacao_manual == 1) {
            foreach ($anexo as $anexos) {
                $pontuacaoTotalPublica = 0;
                $pontuacaoTotalPrivada = 0;

                if (isset($anexos['anexoAno']) && isset($anexos['anexoMes'])) {

                    $documenDinamico = DocumentoDinamico::findorFail($anexos['documento_id']);

                    if ($documenDinamico->tipo_experiencia == 0) {

                        $pontuacaoTotalPublica = (($anexos['anexoAno'] * $pontuacao_por_ano) + ($anexos['anexoMes'] * $pontuacao_por_mes));

                        if ($pontuacaoTotalPublica > $pontuacao_maxima) {

                            return redirect()->back()->withErrors([
                                'limite' => 'Ops, você passou o limite de pontuação. Pontuação Total Pública: ' . $pontuacaoTotalPublica . '.'
                            ]);
                        }
                        //Fazendo a somatorio de pontos por anexo
                        $editalAnexo = PessoaEditalAnexo::findOrFail($anexos['anexo_id']);
                        $editalAnexo->update([

                            'pontuacao_exp_publico' => $pontuacaoTotalPublica
                        ]);
                        $pontuacaoTotalPublica2 = $pontuacaoTotalPublica2 + $pontuacaoTotalPublica;
                    } else {
                        $pontuacaoTotalPrivada = (($anexos['anexoAno'] * $pontuacao_por_ano) + ($anexos['anexoMes'] * $pontuacao_por_mes));

                        if ($pontuacaoTotalPrivada > $pontuacao_maxima) {

                            return redirect()->back()->withErrors([
                                'limite' => 'Ops, você passou o limite de pontuação. Pontuação Total Privada: ' . $pontuacaoTotalPrivada . '.'
                            ]);
                        }
                        $editalAnexo = PessoaEditalAnexo::findOrFail($anexos['anexo_id']);
                        $editalAnexo->update([

                            'pontuacao_exp_privado' => $pontuacaoTotalPrivada
                        ]);
                        $pontuacaoTotalPrivada2 = $pontuacaoTotalPrivada2 + $pontuacaoTotalPrivada;
                    }
                }
                $pessoa->update([
                    'status_revisado' => null
                ]);
            }
            $pontuacaoTotal = $pontuacaoTotalPrivada2 + $pontuacaoTotalPublica2;

        } else {
            foreach ($anexo as $anex) {
                if ($anex[0] != 0 && $anex[0] != 1) {
                    $pontuacao_verificar = $pontuacao_verificar + $anex[0];
                }
            }
            if ($pontuacao_verificar > $pontuacao_maxima) {

                return redirect()->back()->withErrors([
                    'limite' => 'Ops, você passou o limite de pontuação. Pontuação: ' . $pontuacao_verificar . '.'
                ]);
            }

            $pessoa->update([
                'status_revisado' => null
            ]);

            foreach ($pessoa->pessoaEditalAnexos as $editalAnexo) {

                if (!is_null($editalAnexo->documentoDinamico->pontuacao_maxima) && !is_null($editalAnexo->documentoDinamico->pontuacao_por_item)) {

                    if ($anexo[$editalAnexo->id][0] >= 0) {
                        $editalAnexo->update([
                            'pontuacao' => $anexo[$editalAnexo->id][0]
                        ]);
                        if ($anexo[$editalAnexo->id][0] != 1) {
                            $pontuacaoTotal = $pontuacaoTotal + $anexo[$editalAnexo->id][0];
                        }
                    }
                }
            }
        }

        $transparencia = Transparencia::create([
            'instrutor_id' => auth()->id(),
            'pessoa_id' => $pessoa->id,
            'tela' => $url,
            'pontuacao_total' => $pontuacaoTotal,
        ]);

        $pontuacao = Pontuacao::create([

            'pessoa_id' => $pessoa->id,
            'avaliador_id' => auth()->id(),
            'pontuacao_total' => $pontuacaoTotal,
            'pontuacao_total_publica' => $pontuacaoTotalPublica2,
            'pontuacao_total_privada' => $pontuacaoTotalPrivada2,
        ]);

        $pessoa->update([
            'status_avaliado' => 1
        ]);

        if (!is_null($transparencia) && !is_null($pontuacao)) {
            session()->put('sucess', 'Avaliação Realizada com sucesso. Pontuação Geral: ' . $pontuacaoTotal . '');
        } else session()->put('error', 'Não possível avaliar essa pessoa.');
        return redirect()->route('/visualizacao', $pessoa->edital_dinamico_id);
    }

    public
    function reprovar(Request $request)
    {
        $pessoa = Pessoa::findOrFail($request->pessoa_id);
        $pessoa->update([
            'status_revisado' => null
        ]);
        $reprovar = new ReprovarPessoa();

        $reprovar->pessoa_id = $pessoa->id;
        $reprovar->avaliador_id = auth()->user()->id;
        $reprovar->motivo = $request->motivo_rep;

        $pessoa->update([
            'status_avaliado' => 0,
        ]);

        foreach ($pessoa->pessoaEditalAnexos as $editalAnexo){
            if (!is_null($editalAnexo->documentoDinamico->pontuacao_maxima) && !is_null($editalAnexo->documentoDinamico->pontuacao_por_item)) {
                $editalAnexo->update([
                    'pontuacao' => 0
                ]);
            }
        }

        if ($reprovar->save()) {
            session()->put('sucess', 'Pessoa avaliado com sucesso.');
            $url = str_replace("Novo/", "", $_SERVER["REQUEST_URI"]);
            $transparencia = Transparencia::create([
                'instrutor_id' => auth()->id(),
                'pessoa_id' => $pessoa->id,
                'tela' => $url,
                'pontuacao_total' => 0,
            ]);

            $pontuacao = Pontuacao::create([
                'pessoa_id' => $pessoa->id,
                'avaliador_id' => auth()->id(),
                'pontuacao_total' => 0,
            ]);
        } else session()->put('error', 'Não foi possível avaliar essa pessoa.');
        return redirect()->route('/visualizacao', $pessoa->edital_dinamico_id);
    }

    public
    function reavaliar()
    {

    }

}
