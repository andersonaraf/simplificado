<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\EscolaridadeEditalDinamico;
use App\Models\Formulario;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class CargoController extends Controller
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
        //BLOQUEAR FORMULARIO
        $formulario = Formulario::find($request->formulario_id);
        if ($formulario->formularioUsuario->count > 0) return response()->json(['type' => 'error', 'msg' => 'Formulário bloqueado para edição!'], 403);
        try {
            DB::beginTransaction();
            $cargo = new Cargo();
            $cargo->escolaridade_id = $request->escolaridade;
            $cargo->cargo = $request->nomeCargo;
            $cargo->save();
            DB::commit();
            return redirect()->route('configuracao.show', $request->formularioID)->with([
                'type' => 'success',
                'msg' => 'Cargo cadastrado com sucesso.'
            ]);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with([
                'type' => 'error',
                'msg' => 'Ops, ago de errado aconteceu: ' . $exception->getMessage()
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
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cargo = Cargo::findOrFail($id);
        $escolaridadeEditalDinamico = $cargo->escolaridadeEditalDinamico;
        return view('pages.lista-inscricoes.escolaridades.cargos.edita',
            compact('cargo', 'escolaridadeEditalDinamico'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $cargo = Cargo::findOrFail($request->cargo_id);
        $cargo->cargo = $request->inputCargo;

        if (!$cargo->update()) {
            return redirect()->back()->withErrors(['error' => 'Ops, não foi possível alterar o nome do cargo.']);
        }
        return redirect()->back()->with(['sucess' => 'Cargo alterado com sucesso.']);

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
            DB::beginTransaction();
            $cargo = Cargo::findOrFail($id);
            $cargo->delete();
            DB::commit();
            return true;
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->withException($ex->getMessage());
        }
    }
}
