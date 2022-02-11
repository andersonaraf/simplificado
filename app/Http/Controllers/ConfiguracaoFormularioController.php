<?php

namespace App\Http\Controllers;

use App\Models\Atributo;
use App\Models\Campo;
use App\Models\Formulario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfiguracaoFormularioController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $formulario = Formulario::findOrFail($id);
        return view('pages.formulario.configuração.create', compact('formulario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        $request->tipo_campo;
        $request->required_campo;
        try {
            if ($request->tipo_campo) {
                Atributo::create([
                    'name' =>$request->titulo_campo ,
                    'required'=> true,
                ]);
                if (is_null($request->pontuacao) && isset($request->titulo_campo)) {
                    Campo::create([
                        'ponto' => $request->pontuacao,
                        'nome' => $request->titulo_campo,
                        'pontuar'=> false,
                    ]);
                }elseif (!is_null($request->pontuacao) && isset($request->titulo_campo)){
                    Campo::create([
                        'ponto' => $request->pontuacao,
                        'nome' => $request->titulo_campo,
                        'pontuar'=> $request->pontuacao ,
                    ]);
                }
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return response()->withException($e->getMessage());
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
        return $this->create($id);
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

//        try {
//            \DB::beginTransaction();
//            $formulario = Formulario::findOrFail($id);
//            $formulario->delete();
//            \DB::commit();
//            return response()->json('Formulário removido com sucesso.');
//        } catch (\Exception $exception) {
//            dd($exception);
//            \DB::rollBack();
//            return response()->json(false, '405');
//        }
    }
}
