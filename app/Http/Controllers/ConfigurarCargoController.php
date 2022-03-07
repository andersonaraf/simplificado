<?php

namespace App\Http\Controllers;

use App\Models\Campo;
use App\Models\Cargo;
use App\Models\ItemCampo;
use App\Models\TipoCampo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfigurarCargoController extends Controller
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
    public function create($id)
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
        $cargo = Cargo::findOrFail($id);
        $tipo_campo = TipoCampo::all();
        return view('pages.formulario.configuração.campos.show', compact('cargo', 'tipo_campo'));
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
    }

    public function teste($id)
    {

    }

    public function cadastarItemSelect(Request $request)
    {
        try {
            DB::beginTransaction();
            ItemCampo::create($request->all());
            DB::commit();
            return response()->json(201);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(500);
        }
    }

    public function editarCampo(Request $request, $id){
        try{
            DB::beginTransaction();
            $campo = Campo::findOrFail($id);
            $campo->update($request->all());
            DB::commit();
            return response()->json(200);
        }catch (\Exception $exception){
            DB::rollBack();
            return response()->json(500);
        }
    }
}
