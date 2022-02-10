<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormularioRequest;
use App\Models\Formulario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormularioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $formularios = Formulario::all();
        return view('pages.formulario.index', compact('formularios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.formulario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormularioRequest $request)
    {
        //VALIDAR DATAS
        if (strtotime($request->dataInicio) < strtotime($request->dataFinalizar) && strtotime(date('Y-m-d', strtotime($request->dataInicio))) >= strtotime(date('Y-m-d'))) {
            //OBJETO FORMULÁRIO
            try {
                \DB::beginTransaction();
                $formulario = new Formulario();
                $formulario->nome = mb_strtoupper($request->nomeFormulario);
                $formulario->pontuacao = $request->pontuacaoTotal;
                $formulario->data_liberar = $request->dataInicio;
                $formulario->data_fecha = $request->dataFinalizar;
                $formulario->liberado = false;
                $formulario->save();
                \DB::commit();
                return redirect()->route('configuracao.create', $formulario->id)->with([
                    'type' => 'success',
                    'msg' => 'Formulário criado com sucesso. Agora é hora de configurar.'
                ]);
            } catch (\Exception $exception) {
                \DB::rollBack();
                return redirect()->back()->with([
                    'type' => 'error',
                    'msg' => 'Algo de errado aconteceu. ' . $exception->getMessage()
                ]);
            }
        } else {
            //DEVOLVER PARA TELA DE CADASTRO
            return redirect()->back()->with([
                'type' => 'error',
                'msg' => 'As datas informadas estão inválidas.'
            ]);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $formulario = Formulario::findOrFail($id);
        return view('pages.formulario.edit', compact('formulario'));
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
        try {
            DB::beginTransaction();
            $formulario = Formulario::findOrFail($id);
            $formulario->update($request->all());
            DB::commit();
            return redirect()->route('formulario.index', $formulario->id)->with([
                'type' => 'success',
                'msg' => 'Formulário Atualizado com sucesso. '
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with([
                'type' => 'error',
                'msg' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            \DB::beginTransaction();
            $formulario = Formulario::findOrFail($id);
            $formulario->delete();
            \DB::commit();
            return response()->json('Formulário removido com sucesso.');
        } catch (\Exception $exception) {
            dd($exception);
            \DB::rollBack();
            return response()->json(false, '405');
        }


    }
}
