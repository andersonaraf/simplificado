<?php

namespace App\Http\Controllers;

use App\Models\Formulario;
use App\Models\FormularioUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VoltarUsuarioController extends Controller
{
    public function index()
    {
        $formularios = Formulario::where('user_id', Auth::user()->id)->get();
        return view('pages.formulario.voltar_usuario.index' , compact('formularios'));
    }


    public function listarPessoas($id){
        $formularioUsuarios = FormularioUsuario::where('formulario_id', $id)->get();
        return view('pages.formulario.voltar_usuario.listarPessoas', compact('formularioUsuarios'));
    }

    public function voltarAvaliacao(Request $request)
    {
        try {
            DB::beginTransaction();
            $formularioUsuario = FormularioUsuario::findOrFail($request->formularioUsuarioID);
            $formularioUsuario->avaliado = null;
            $formularioUsuario->pontuacao_total = 0;
            $formularioUsuario->revisado = null;
            $formularioUsuario->save();
            DB::commit();
            return response()->json(true, 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(false, 500);
        }
    }

    public function voltarRevisao(Request $request)
    {
        try {
            DB::beginTransaction();
            $formularioUsuario = FormularioUsuario::findOrFail($request->formularioUsuarioID);
            $formularioUsuario->revisado = null;
            $formularioUsuario->save();
            DB::commit();
            return response()->json(true, 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(false, 500);
        }
    }
}
