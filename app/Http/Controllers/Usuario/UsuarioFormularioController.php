<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Models\Collapse;
use App\Models\Formulario;
use App\Models\FormularioUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsuarioFormularioController extends Controller
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
    public function create($cargo_id, $formulario_id)
    {
        $collapses = Collapse::where('cargo_id', $cargo_id)->get();
        return view('usuario.formulario.cadastro', compact('collapses', 'formulario_id', 'cargo_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            dd($request->except(['formulario', 'cargo']));
        try{
            DB::beginTransaction();
            $formulario_usuario =  new FormularioUsuario();
            $formulario_usuario->user_id = Auth::user()->id;
            $formulario_usuario->formulario_id = $request->formulario;
            $formulario_usuario->cargo_id = $request->cargo;
            $formulario_usuario->save();
            dd($formulario_usuario);
//            DB::commit();
        }catch(\Exception $exception){
            DB::rollBack();
            return redirect()->back();
        }
        foreach ($request->except(['formulario', 'cargo']) as $key=>$input){
            dd($request[$key]);
        }
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
        $formulario = Formulario::findOrFail($id);
        return view('usuario.formulario.show', compact('formulario'));
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
    }
}
