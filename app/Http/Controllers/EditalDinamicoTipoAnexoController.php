<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\DocumentoDinamico;
use App\Models\EditalDinamico;
use App\Models\EditalDinamicoTipoAnexo;
use App\Models\Escolaridade;
use App\Models\EscolaridadeEditalDinamico;
use App\Models\Progress;
use App\Models\TipoAnexo;
use App\Models\TipoAnexoCargo;
use Illuminate\Http\Request;

class EditalDinamicoTipoAnexoController extends Controller
{
    //
    public function index($id)
    {
        $editalDinamico = EditalDinamico::findOrFail($id);
        $editalAnexos = EditalDinamicoTipoAnexo::where('edital_dinamico_id', $editalDinamico->id)->get();
        $tiposAnexos = TipoAnexo::all();
        $escolaridade_edital_dinamicos = EscolaridadeEditalDinamico::where('edital_dinamico_id', $editalDinamico->id)->get();
        return view('pages.lista-inscricoes.configuracoes.list', compact('editalAnexos', 'escolaridade_edital_dinamicos', 'tiposAnexos', 'editalDinamico'));
    }

    public function store(Request $request)
    {
        $progress = Progress::where('tipo_anexo_id', $request->inputTipoAnexo)->where('edital_dinamico_id', $request->editalDinamicoID)->first();
        $editalDinamicoTipoAnexos = EditalDinamicoTipoAnexo::create([
            'edital_dinamico_id' => $request->editalDinamicoID,
            'tipo_anexo_id' => $request->inputTipoAnexo,
            'cargo_id' => $request->inputCargo,
        ]);

        $tipoAnexoCargo = TipoAnexoCargo::where('cargo_id', $request->inputCargo)->where('tipo_anexo_id', $request->inputTipoAnexo)->first();
        if (is_null($tipoAnexoCargo)) {
            TipoAnexoCargo::create([
                'cargo_id' => $request->inputCargo,
                'tipo_anexo_id' => $request->inputTipoAnexo,
            ]);
        }

        if (!is_null($editalDinamicoTipoAnexos)) {
            $documentoDinamico = DocumentoDinamico::create([
                'edital_dinamico_tipo_anexo_id' => $editalDinamicoTipoAnexos->id,
                'nome_documento' => $request->inputNomeAnexo,
                'obrigatorio' => $request->inputObrigatorio,
                'pontuacao_maxima_documento' => $request->inputPontuacaoMaxima,
                'pontuacao_maxima_item' => $request->inputPontuacaoMaximaDoItem,
                'pontuacao_por_item' => $request->inputPontuacaoPorItem,
                'quantidade_anexos' => $request->inputQuantiadeAnexos,
                'pontuacao_por_ano' => $request->inputPorAno,
                'pontuacao_por_mes' => $request->inputPorMes,
                'tipo_experiencia' => $request->inputTipoExperiencia,
                'pontuacao_manual' => $request->inputPontuacaoManual
            ]);
            if (is_null($progress)) {
                Progress::create([
                    'tipo_anexo_id' => $request->inputTipoAnexo,
                    'edital_dinamico_id' => $request->editalDinamicoID
                ]);
            }
        }

        if (!is_null($documentoDinamico)) {
            session()->put('sucess', 'Anexo Cadastrado com sucesso');
        } else session()->put('error', 'Não foi possível fixar essa documento ao formulário, entre em contato com suporte do sistema.');
        return redirect()->route('edital.formulario.anexo', $request->editalDinamicoID);
    }

    public function edit($id)
    {
        $editalDinamico = EditalDinamico::findOrFail($id);
        $editalAnexos = EditalDinamicoTipoAnexo::where('edital_dinamico_id', $editalDinamico->id)->get();
        $tiposAnexos = TipoAnexo::all();
        $escolaridade_edital_dinamicos = EscolaridadeEditalDinamico::where('edital_dinamico_id', $editalDinamico->id)->get();
        return view('pages.lista-inscricoes.configuracoes.edita',
            compact($editalAnexos, $tiposAnexos, $escolaridade_edital_dinamicos));

    }

    public function update(Request $request)
    {
        $editalAnexo = EditalDinamicoTipoAnexo::findOrFail($request->editalDinamicoTipoAnexoID);
        $editalAnexo->cargo_id = $request->inputCargo;
        $editalAnexo->tipo_anexo_id = $request->inputTipoAnexo;
        $documento = $editalAnexo->documentoDinamico;
        $documento->obrigatorio = $request->inputObrigatorio;
        $documento->pontuacao_maxima_documento = $request->inputPontuacaoMaxima;
        $documento->pontuacao_maxima_item = $request->inputPontuacaoMaximaDoItem;
        $documento->pontuacao_por_item = $request->inputPontuacaoPorItem;
        $documento->quantidade_anexos = $request->inputQuantiadeAnexos;
        $documento->pontuacao_por_ano = $request->inputPorAno;
        $documento->pontuacao_por_mes = $request->inputPorMes;
        $documento->tipo_experiencia = $request->inputTipoExperiencia;
        $documento->pontuacao_manual = $request->inputPontuacaoManual;

        //ATUALIZAR NA BASE DE DADOS
        if ($editalAnexo->update() && $documento->update()) {
            session()->put('sucess', 'Alterações realizadas com sucesso.');
        } else session()->put('error', 'Não foi possível alterar as informações.');
        return redirect()->back();
    }
}
