<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Collapse;
use App\Models\Formulario;
use App\Models\FormularioUsuario;
use App\Models\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth')->except('logout');
    }

    public function index()
    {
        $formularioUsuario = FormularioUsuario::where('user_id', Auth::id())->first();
        $pessoa = Pessoa::where('user_id', Auth::id())->first();
        if (Auth::user()->tipo == 'CANDIDATO') {
            //acrescentar id dinamico (este funcionando apenas para testes)
            $nome_user = Auth::user()->name;
            $user_id = Auth::user()->id;

            return view('usuario.area_user.index_user', compact('nome_user', 'pessoa', 'formularioUsuario', 'user_id'));
        } else {
            return view('inicio');
        }
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

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        Listar todos os processo do usuario
        $formularioUsuario = FormularioUsuario::where('user_id', $id)->first();
        if (!is_null($formularioUsuario)) {
            $formulario = Formulario::where('id', $formularioUsuario->formulario_id)->first();
            $cargo = Cargo::where('id', $formularioUsuario->cargo_id)->first();

            //campo deve ser dinamico buscando em tabela
            $recurso_hability = true;

            return view('usuario.area_user.processos_seletivos_user', compact('formularioUsuario', 'cargo', 'formulario', 'recurso_hability'));

        } else {
            $formularioUsuario = null;
            return view('usuario.area_user.processos_seletivos_user', compact('formularioUsuario'));

        }


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
