<?php

namespace App\Http\Controllers\TelasDinamicas;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoTelaRequest;
use App\Models\EditalDinamico;
use App\Models\TipoTela;
use Illuminate\Http\Request;

class TipoTelaController extends Controller
{
    //
    public function store(TipoTelaRequest $request)
    {
        //SALVA PDF
        if ($request->tipo_tela == 2) {
            //VERIFICAR SE O PDF VEIO
            if ($request->nome_pdf == '0') {
                session()->put('error', 'Parece que você não selecionou o PDF!');
                return redirect()->route('tela-criar');
            } else {
                //VERIFICAR SE O NOME JA EXISTE
                $tipoTela = TipoTela::where('nome_ou_anexo', $request->nome_pdf)->first();
                if (!is_null($tipoTela)) {
                    session()->put('error', 'Parece que esse anexo já está sendo utilizado!');
                    return redirect()->route('tela-criar');
                }
                //UPLOAD FILE
                $documento = $request->pdf_carregar;
                //GET NAME FILE
                $name = $documento->getClientOriginalName();
                //MOVE FILE
                $upload = $documento->move('anexos', $name);
                //VALIDATION UPLOAD
                if (!$upload) {
                    session()->put('error', 'Algo de errado aconteceu, entre em contato com o suporte.');
                    return redirect()->route('tela-criar');
                } else {
                    TipoTela::create([
                        'tipo_tela_id' => 2,
                        'nome_anexo_mostrar' => $request->tela_nome_pdf,
                        'nome_ou_anexo' => $name,
                        'status_liberar' => $request->status_liberar,
                        'data_liberar' => $request->data_liberar,
                    ]);
                }

                session()->put('sucess', 'Tela Criada com sucesso!');
                return redirect()->route('tela-criar');
            }
        } //SALVAR TELA
        else if ($request->tipo_tela == 1) {
            //VERIFICAR SE O NOME JA EXISTE
            $tipoTela = TipoTela::where('nome_ou_anexo', $request->nome_tela)->first();
            if (!is_null($tipoTela)) {
                session()->put('error', 'Parece que esse nome já está sendo utilizado!');
                return redirect()->route('tela-criar');
            }
            TipoTela::create([
                'tipo_tela_id' => 1,
                'nome_ou_anexo' => $request->tela_nome,
                'status_liberar' => $request->status_liberar,
                'data_liberar' => $request->data_liberar,
            ]);
            session()->put('sucess', 'Tela Criada com sucesso!');
            return redirect()->route('tela-criar');
        } else if ($request->tipo_tela == 3) {
//            dd($request->all());
            $tipoTela = TipoTela::where('nome_ou_anexo', $request->nome_tela)->first();
            if (!is_null($tipoTela)) {
                session()->put('error', 'Parece que esse nome já está sendo utilizado!');
                return redirect()->route('tela-criar');
            }
            $tipoTela = TipoTela::create([
                'tipo_tela_id' => 3,
                'nome_ou_anexo' => $request->tela_nome,
                'status_liberar' => $request->status_liberar,
                'data_liberar' => $request->data_liberar,
            ]);

            EditalDinamico::create([
                'tipo_tela_id' => $tipoTela->id,
            ]);
            session()->put('sucess', 'Tela Criada com sucesso!');
            return redirect()->route('tela-criar');
        } //ERROS FINAIS
        else {
            session()->put('error', 'Parece que algo de errado aconteceu!');
            return redirect()->route('tela-criar');
        }
        session()->put('error', 'Parece que algo de errado aconteceu!');
        return redirect()->route('tela-criar');
    }


    public function delete($id)
    {
        $tela = TipoTela::findOrFail($id);
        $tela->delete();
        session()->put('sucess', 'Tela Apagada com Sucesso!');
        return redirect()->route('tela-liberar');
    }

    public function show($id)
    {
        $tela = TipoTela::findOrFail($id);

        $directory = public_path();
        $files = \File::allFiles($directory);

        return view('pages.telas-dinamicas.tela-mostra-unico', [
            'tela' => $tela,
            'arquivos' => $files,
        ]);
    }

    public function update(Request $request, $id)
    {
//        dd($request->all());
        //VERIFICAR SE N FOI MARCADO A DATA E SELECIONADO O LIBERAR
        if ($request->status_liberar == '1' && !is_null($request->data_liberar)) {
            session()->put('error', 'Parece que algo de errado aconteceu!');
            return redirect()->route('tela-unica-mostra', $id);
        }

        //CRAIR UMA VARIVAVEL COM OS DADOS DA TELA PARA SER EDITADA
        $tela = TipoTela::findOrFail($id);
        //VERIFICA SE A TELA EXISTE
        if (is_null($tela)) {
            session()->put('error', 'Parece que algo de errado aconteceu!');
            return redirect()->route('tela-liberar');
        } else {
            //EDITAR A TELA
            $tela->update([
                'nome_ou_anexo' => $request->nome_ou_anexo,
                'status_liberar' => $request->status_liberar,
                'data_liberar' => $request->data_liberar,
                'data_fecha' => $request->data_final
            ]);
            session()->put('sucess', 'Tela Editada com Sucesso!');
            return redirect()->route('tela-unica-mostra', $id);
        }
    }
}
