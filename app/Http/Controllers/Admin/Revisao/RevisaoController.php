<?php

namespace App\Http\Controllers\Admin\Revisao;

use App\Http\Controllers\Controller;
use App\Http\Requests\Recurso;
use App\Models\Formulario;
use App\Models\FormularioUsuario;
use App\Models\GrupoUser;
use App\Models\ReprovarMotivo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RevisaoController extends Controller
{
    public function index()
    {
        $grupoUsers = GrupoUser::where('user_id', Auth::user()->id)->get();
        return view('pages.revisao.index', compact('grupoUsers'));
    }

    public function show($id)
    {
        $formulario = Formulario::findOrFail($id);
        return view('pages.revisao.show', compact('formulario'));
    }

    public function showDados($id)
    {
        $formularioUsuario = FormularioUsuario::findOrFail($id);
        $reprovar = ReprovarMotivo::where('formulario_usuario_id', $id)->first();
        if (!$formularioUsuario->lock || (strtotime($formularioUsuario->lock) < strtotime('-15minutes')) || $formularioUsuario->user_id_is_assessing == Auth::id()) {
            $formularioUsuario->lock = Carbon::now();
            $formularioUsuario->user_id_is_assessing = Auth::id();
            $formularioUsuario->save();
            return view('pages.revisao.candidato.show', compact('formularioUsuario', 'reprovar'));
        }
        else return redirect()->back()->with(['type' => 'warning', 'msg' => 'O formulário está sendo avaliado por outro usuário, por favor, tente novamente mais tarde.']);
    }

    public function voltarAvaliacao(Request $request)
    {
        try {
            DB::beginTransaction();
            $formularioUsuario = FormularioUsuario::findOrFail($request->formularioUsuarioID);
            $formularioUsuario->avaliado = null;
            $formularioUsuario->pontuacao_total = 0;
            $formularioUsuario->save();
            DB::commit();
            return response()->json(true, 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(false, 500);
        }
    }

    public function reprovarAvaliacao(Request $request)
    {
        try {
            DB::beginTransaction();
            $formularioUsuario = FormularioUsuario::findOrFail($request->formularioUsuarioID);
            $formularioUsuario->revisado = 0;
            $formularioUsuario->save();
            DB::commit();
            return response()->json(true, 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(false, 500);
        }
    }

    public function aprovarAvaliacao(Request $request)
    {
        try {
            DB::beginTransaction();
            $formularioUsuario = FormularioUsuario::findOrFail($request->formularioUsuarioID);
            $formularioUsuario->revisado = 1;
            $formularioUsuario->save();
            DB::commit();
            return response()->json(true, 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(false, 500);
        }
    }
}
