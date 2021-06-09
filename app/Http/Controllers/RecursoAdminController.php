<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecursoAdminRequest;
use App\Models\EditalDinamico;
use App\Models\Pessoa;
use Illuminate\Http\Request;

class RecursoAdminController extends Controller
{
    //
    public function index()
    {
        $editalDinamicos = EditalDinamico::all();
        $progressQuantiadePorcento = '';
        return view('pages.recurso-tipo-edital', compact('editalDinamicos'));
    }

    public function negar(RecursoAdminRequest $request)
    {
        $pessoa = Pessoa::findOrFaiL($request->pessoa_id);
//        dd([$request->all(), $pessoa, $pessoa->recurso, date('Y-m-d H:i:s')]);

        if (!is_null($pessoa->recurso->status)) {
            session()->put('error', 'Esse recurso já foi avaliado.');
        }

        $pessoa->recurso->update([
            'avaliador_id' => auth()->user()->id,
            'status' => 0,
            'data_avaliado' => date('Y-m-d H:i:s'),
            'recusar_motivo' => $request->motivo_reav,
        ]);

        session()->put('sucess', 'Recuso negado com sucesso.');
        return redirect()->route('visualizacao-recurso', $pessoa->edital_dinamico_id);
    }

    public function aceitar(Request $request)
    {
        $pessoa = Pessoa::findOrFaiL($request->pessoa_id);

        if (!is_null($pessoa->recurso->status)) {
            session()->put('error', 'Esse recurso já foi avaliado.');
        }

        $pessoa->recurso->update([
            'avaliador_id' => auth()->user()->id,
            'status' => 1,
            'data_avaliado' => date('Y-m-d H:i:s'),
            'recusar_motivo' => $request->motivo_reav,
        ]);

        $pessoa->status = null;
        $pessoa->status_avaliado = null;
        $pessoa->status_revisado = null;

        if ($pessoa->update()) {
            session()->put('sucess', 'Recurso avaliado com sucesso, enviado para avaliação.');
        } else session()->put('error', 'Não foi possível aceitar esse recurso, entre em contato com o suporte do sistema.');
        return redirect()->route('visualizacao-recurso', $pessoa->edital_dinamico_id);
    }
}
