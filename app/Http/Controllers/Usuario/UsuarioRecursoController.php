<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Http\Requests\Recurso;
use App\Http\Requests\UsuarioRecursoStoreRequest;
use App\Models\Formulario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioRecursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        return view('usuario.area_user.recurso_user');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $formulario = Formulario::findOrFail($id);
        if ($formulario->liberar_recurso == 1 || (strtotime($formulario->data_liberar_recurso) <= strtotime(date('Y-m-d H:i:s')) && strtotime($formulario->data_fecha_recurso) >= strtotime(date('Y-m-d H:i:s')))) {
            return view('usuario.area_user.recurso_user', compact('formulario'));
        } else {
            return redirect()->route('usuario.lista.processos', \auth()->user()->id)->with(['type' => 'warning', 'msg' => 'Recurso não liberado']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRecursoStoreRequest $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
}
