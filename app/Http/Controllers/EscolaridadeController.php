<?php

namespace App\Http\Controllers;

use App\Models\Escolaridade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EscolaridadeController extends Controller
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
        //
        try {
            \DB::beginTransaction();
            $escolaridade = new Escolaridade();
            $escolaridade->formulario_id = $request->formularioID;
            $escolaridade->nivel_escolaridade = mb_strtoupper($request->nomeEscolaridade);
            $escolaridade->bloquear = 0;
            $escolaridade->save();
            \DB::commit();
            return redirect()->route('configuracao.create', $request->formularioID)->with([
                'type' => 'success',
                'msg' => 'Nova escolaridade cadastrada.'
            ]);
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with([
                'type' => 'error',
                'msg' => 'Algo de errado aconteceu: ' . $exception->getMessage()
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
        //
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
        try {
            \DB::beginTransaction();
            $escolaridade = Escolaridade::findOrFail($id);
            $escolaridade->delete();
            \DB::commit();
            return response()->json('Cargo deletado com sucesso.');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return response()->json(false, 405);
        }
    }

    public function bloquear(Request $request)
    {
        try {
            DB::beginTransaction();
            $escolaridade = Escolaridade::findOrFail($request->escolaridade_id);
            $escolaridade->bloquear = !$escolaridade->bloquear;
            $escolaridade->save();
            foreach ($escolaridade->cargos as $cargo){
                $cargo->bloquear = $escolaridade->bloquear;
                $cargo->save();
            }
            DB::commit();
            return response()->json(true, 200);
        }catch (\Exception $exception){
            DB::rollBack();
            return response()->json(false, 500);
        }
    }
}
