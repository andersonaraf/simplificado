<?php

namespace App\Http\Controllers\Admin\Configuracao\Formulario;

use App\Http\Controllers\Controller;
use App\Models\Atributo;
use App\Models\Campo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampoController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            DB::beginTransaction();
            $campo = Campo::findOrFail($id);
            $atributos = $campo->atributos;
            $campo->delete();
            $atributos->delete();
            DB::commit();
            return response()->json(['type' => 'success', 'msg' => 'Campo excluído com sucesso!']);
        }catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['type' => 'error', 'msg' => 'Erro ao excluir o campo!']);
        }
    }
}
