<?php

namespace App\Http\Controllers\Admin\Avaliacao;

use App\Http\Controllers\Controller;
use App\Models\Formulario;

class FormularioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TRAZER SOMENTE OS FORMULARIO QUE O USUÁRIO TEM ACESSO.
        $formularios = Formulario::with(['grupoFormulario' => function ($query) {
            $query->with(['grupo' => function ($query) {
                $query->with(['grupoUsers' => function ($query) {
                    $query->where('user_id', auth()->user()->id);
                }]);
            }]);
        }])->get();
        return view('pages.avaliacao.index', compact('formularios'));
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
        return view('pages.avaliacao.show', compact('formulario'));
    }
}
