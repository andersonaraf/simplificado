<?php

namespace App\Http\Controllers\Admin\Revisao;

use App\Http\Controllers\Controller;
use App\Models\Formulario;
use App\Models\FormularioUsuario;
use App\Models\ReprovarMotivo;
use Illuminate\Http\Request;

class RevisaoController extends Controller
{
    public function index()
    {
        $formularios = Formulario::with(['grupoFormulario' => function ($query) {
            $query->with(['grupo' => function ($query) {
                $query->with(['grupoUsers' => function ($query) {
                    $query->where('user_id', auth()->user()->id);
                }]);
            }]);
        }])->get();
        return view('pages.revisao.index', compact('formularios'));
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
        return view('pages.revisao.candidato.show', compact('formularioUsuario', 'reprovar'));
    }

}
